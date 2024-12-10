import React, { useState } from "react";
import FormCard from "../../components/form/formCard";
import InputField from "../../components/form/inputField";
import SaveButton from "../../components/buttons/saveButton";
import CancelButton from "../../components/buttons/cancelButton";
import axios from "axios";

const endpoint = `http://localhost:8000/api/edificios`;

const RegistrarEdificioForm = () => {
  const [formData, setFormData] = useState({
    nombre_edificio: "",
    pisos: "",
    geolocalizacion: "",
  });

  const [errors, setErrors] = useState({
    nombre_edificio: "",
    pisos: "",
    geolocalizacion: "",
  });

  const handleChange = (e) => {
    const { id, value } = e.target;
    setFormData({ ...formData, [id]: value });
  };

  const handleCancel = () => {
    console.log("Registro cancelado");
  };

  const handleSave = async (e) => {
    e.preventDefault();

    try {
      const response = await axios.post(endpoint, formData);
      console.log(response);
      if (response.data.success) {
        console.log("Datos guardados correctamente", response.data);
        setErrors({});
      }
    } catch (error) {
      console.error("Error al guardar los datos:", error);
      if (error.response && error.response.data) {
        const errorMessages = error.response.data.error.reduce((acc, curr) => {
          if (curr.detail.includes("nombre del edificio")) {
            acc.nombre_edificio = curr.detail;
          } else if (curr.detail.includes("pisos")) {
            acc.pisos = curr.detail;
          }else if (curr.detail.includes("geolocalizacion")) {
            acc.geolocalizacion = curr.detail;
          }
          return acc;
        }, {});
        setErrors(errorMessages);
      }
    }
  };



  return (
    <FormCard title="Registrar Edificio">
      <InputField
        label="Nombre del edificio:"
        id="nombre_edificio"
        placeholder="Ingrese el nombre del edificio"
        value={formData.nombre_edificio}
        onChange={handleChange}
        error={errors.nombre_edificio}
      />
      <InputField
        label="pisos:"
        id="pisos"
        placeholder="Ingrese los pisos"
        value={formData.pisos}
        onChange={handleChange}
        error={errors.pisos}
      />

      <InputField
        label="Geolocalización:"
        id="geolocalizacion"
        placeholder="Ingrese la geolocalización"
        value={formData.geolocalizacion}
        onChange={handleChange}
        error={errors.geolocalizacion}
      />

      <div className="d-flex justify-content-between">
        <CancelButton onClick={handleCancel} />
        <SaveButton onClick={handleSave} />
      </div>
    </FormCard>
  );
};

export default RegistrarEdificioForm;

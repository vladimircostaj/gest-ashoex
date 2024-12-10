import React, { useState } from "react";
import FormCard from "../../components/form/formCard";
import InputField from "../../components/form/inputField";
import SelectField from "../../components/form/selectField";
import SaveButton from "../../components/buttons/saveButton";
import CancelButton from "../../components/buttons/cancelButton";
import axios from "axios";
import { useEffect } from "react";

const endpoint = `http://localhost:8000/api/aulas`;

const RegistrarAulaForm = () => {
  const [formData, setFormData] = useState({
    numero_aula: "",
    capacidad: "",
    id_edificio: "",
    ubicacion:"",
  });
  const [edificios, setEdificios] = useState([]);
  const [errors, setErrors] = useState({
    numero_aula: "",
    capacidad: "",
    id_edificio: "",
    ubicacion:""
  });

  useEffect(() => {
    const fetchEdificios = async () => {
      try {
        const response = await axios.get("http://localhost:8000/api/edificios");
        console.log("Respuesta de la API:", response.data);
        if (response.data.success && Array.isArray(response.data.data)) {
          const formattedEdificios = response.data.data.map((edificio) => ({
            value: edificio.id_edificio, // Usamos 'id_edificio' como valor
            label: edificio.nombre_edificio, // Usamos 'nombre_edificio' como etiqueta
          }));
          setEdificios(formattedEdificios);
        } else {
          console.error("La propiedad 'data' no es un array o falta en la respuesta");
        }
      } catch (error) {
        console.error("Error al cargar los edificios:", error);
      }
    };
  
    fetchEdificios();
  }, []);
  
  

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
    <FormCard title="Registrar Aula">
      <InputField
        label="Codigo Aula:"
        id="numero_aula"
        placeholder="Ingrese codigo de aula"
        value={formData.numero_aula}
        onChange={handleChange}
        error={errors.numero_aula}
      />
      <InputField
        label="Cantidad de Alumnos"
        id="capacidad"
        placeholder="Ingrese la cantidad de Alumnos"
        value={formData.capacidad}
        type="number"
        onChange={handleChange}
        error={errors.capacidad}
      />
      <SelectField
        label="Edificio:"
        id="id_edificio"
        placeholder="Ingrese el edificio donde esta ubicado"
        value={formData.id_edificio}
        onChange={handleChange}
        error={errors.id_edificio}
        options={edificios}
      />

      <InputField
        label="ubicacion:"
        id="ubicacion"
        placeholder="Ingrese la ubicacion"
        value={formData.ubicacion}
        onChange={handleChange}
        error={errors.ubicacion}
      />

      <div className="d-flex justify-content-between">
        <CancelButton onClick={handleCancel} />
        <SaveButton onClick={handleSave} />
      </div>
    </FormCard>
  );
};

export default RegistrarAulaForm;

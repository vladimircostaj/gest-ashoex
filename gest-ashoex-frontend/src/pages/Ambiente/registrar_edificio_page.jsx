import { useState } from "react";
import Title from "../../components/typography/title";
import InputField from "../../components/form/inputField";
import SaveButton from "../../components/buttons/saveButton";
import CancelButton from "../../components/buttons/cancelButton";
import axios from "axios";
import "./registrar_ambiente.css";

const endpoint = `http://localhost:8000/api/edificios`;

const RegistrarEdificioForm = () => {
  const [formData, setFormData] = useState({
    nombre_edificio: "",
    geolocalizacion: "",
  });

  const [disponibles, setDisponibles] = useState({
    ubicaciones: [],
    usos: [],
    facilidades: [],
  });

  const handleChange = (e) => {
    const { id, value } = e.target;
    setFormData({
      ...formData,
      [id]: value,
    });
  };

  const handleCancel = () => {
    console.log("Registro cancelado");
  };

  const handleSave = async (e) => {
    e.preventDefault();
    await axios.post(endpoint, {
      nombre_edificio: formData.nombre_edificio,
      geolocalizacion: formData.geolocalizacion,
    });    
    console.log("Datos guardados:", formData);
  };

  return (
    <div className="form-container">
      <div className="card form-card">
        <div className="mb-3 text-center">
          <Title text="Registrar Edificio" />
        </div>

        <form className="d-flex flex-column gap-3">
          <InputField
            label="Nombre del edificio:"
            id="nombre_edificio"
            placeholder="Ingrese el nombre del edificio"
            value={formData.nombre_edificio}
            onChange={handleChange}
            style={{
              container: { textAlign: "left" },
              input: { width: "100%" },
            }}
          />

          <InputField
            label="Geolocalizacion:"
            id="geolocalizacion"
            placeholder="Ingrese la geolocalizacion"
            value={formData.geolocalizacion}
            onChange={handleChange}
            style={{
              container: { textAlign: "left" },
              input: { width: "100%" },
            }}
          />

          <div className="d-flex justify-content-between gap-2 mt-3">
            <CancelButton onClick={handleCancel} />
            <SaveButton onClick={handleSave} />
          </div>
        </form>
      </div>
    </div>
  );
};

export default RegistrarEdificioForm;

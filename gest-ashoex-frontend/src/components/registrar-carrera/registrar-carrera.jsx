import React, { useState } from "react";
import "./registrar-carrera.css";
// import { registrarCarrera } from "../../services/registrar_carrera_api";

const CrearCarreraForm = () => {
  const [formData, setFormData] = useState({
    codigo: "",
    nombre: "",
    duracion: "",
  });

  const handleChange = (e) => {
    const { name, value } = e.target;
    setFormData({
      ...formData,
      [name]: value,
    });
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    try {
      const response = await registrarCarrera(formData);
      console.log("Carrera registrada:", response);
    } catch (error) {
      console.error("Error al registrar carrera:", error);
    }
  };

  return (
    <div className="crear-carrera-container">
      <h2 className="form-title">Crear Nueva Carrera</h2>
      <form className="form" onSubmit={handleSubmit}>
        <div className="form-group">
          <label htmlFor="codigo">Código:</label>
          <input
            type="text"
            id="codigo"
            name="codigo"
            value={formData.codigo}
            onChange={handleChange}
            required
          />
        </div>
        <div className="form-group">
          <label htmlFor="nombre">Nombre:</label>
          <input
            type="text"
            id="nombre"
            name="nombre"
            value={formData.nombre}
            onChange={handleChange}
            required
          />
        </div>
        <div className="form-group">
          <label htmlFor="duracion">Total de semestres:</label>
          <input
            type="number"
            id="duracion"
            name="duracion"
            value={formData.duracion}
            onChange={handleChange}
            required
            min="1"
          />
        </div>
        <button type="submit">Crear Carrera</button>
      </form>
    </div>
  );
};

export default CrearCarreraForm;

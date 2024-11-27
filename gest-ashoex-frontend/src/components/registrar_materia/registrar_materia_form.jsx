import React, { useState } from "react";
import "./registrar_materia.css";
//import { registrarMateria } from "../../services/registrar_materia_api";

const RegistrarMateriaForm = () => {
  const [formData, setFormData] = useState({
    codigo: "",
    nombre: "",
    tipo: "",
    numero_periodos_academicos: "",
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
      const response = await registrarMateria(formData);
      console.log("Materia registrada:", response);
    } catch (error) {
      console.error("Error al registrar materia:", error);
    }
  };

  return (
    <div className="registrar-materia-container">
      <h2 className="form-title">Registrar Nueva Materia</h2>
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
          <label htmlFor="numero_periodos_academicos">Número de Períodos Académicos:</label>
          <input
            type="number"
            id="numero_periodos_academicos"
            name="numero_periodos_academicos"
            value={formData.numero_periodos_academicos}
            onChange={handleChange}
            required
            min="1"
          />
        </div>
        <button type="submit">Registrar Materia</button>
      </form>
    </div>
  );
};

export default RegistrarMateriaForm;

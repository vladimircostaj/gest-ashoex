import React, { useState } from "react";
import "./registrar_personal_form.css";
import { registrarPersonal } from "../../services/registrar_personal_api";

const RegistrarPersonalForm = () => {
  const [formData, setFormData] = useState({
    name: "",
    email: "",
    telefono: "",
    tipo_personal_id: "",
    estado: "activo",
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
      const response = await registrarPersonal(formData);
      console.log("Datos del formulario:", response);
    } catch (error) {
      console.error("Error al registrar personal:", error);
    }
  };

  return (
    <form className="form" onSubmit={handleSubmit}>
      <div className="form-group">
        <label htmlFor="name">Nombre:</label>
        <input
          type="text"
          id="name"
          name="name"
          value={formData.name}
          onChange={handleChange}
        />
      </div>
      <div className="form-group">
        <label htmlFor="email">Email:</label>
        <input
          type="email"
          id="email"
          name="email"
          value={formData.email}
          onChange={handleChange}
        />
      </div>
      <div className="form-group">
        <label htmlFor="telefono">Teléfono:</label>
        <input
          type="tel"
          id="telefono"
          name="telefono"
          value={formData.telefono}
          onChange={handleChange}
        />
      </div>
      <div className="form-group">
        <label htmlFor="tipo_personal_id">Rol:</label>
        <select
          id="tipo_personal_id"
          name="tipo_personal_id"
          value={formData.tipo_personal_id}
          onChange={handleChange}
        >
          <option value="">Seleccione un rol</option>
          <option value="1">Docente</option>
          <option value="2">Auxiliar</option>
        </select>
      </div>
      <button type="submit">Registrar</button>
    </form>
  );
};

export default RegistrarPersonalForm;

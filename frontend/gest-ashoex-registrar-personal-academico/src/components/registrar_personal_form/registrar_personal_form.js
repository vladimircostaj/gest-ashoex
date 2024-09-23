import React, { useState } from "react";
import "./registrar_personal_form.css";
import { registrarPersonal } from "../../services/registrar_personal_api";

const RegistrarPersonalForm = () => {
  const [formData, setFormData] = useState({
    nombre: "",
    apellido: "",
    email: "",
    telefono: "",
    contrasena: "",
    rol: "",
    grupo: "",
    materia: "",
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
        <label htmlFor="nombre">Nombre:</label>
        <input
          type="text"
          id="nombre"
          name="nombre"
          value={formData.nombre}
          onChange={handleChange}
        />
      </div>
      <div className="form-group">
        <label htmlFor="apellido">Apellido:</label>
        <input
          type="text"
          id="apellido"
          name="apellido"
          value={formData.apellido}
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
        <label htmlFor="contrasena">Contraseña:</label>
        <input
          type="password"
          id="contrasena"
          name="contrasena"
          value={formData.contrasena}
          onChange={handleChange}
        />
      </div>
      <div className="form-group">
        <label htmlFor="materia">Materia:</label>
        <select
          id="materia"
          name="materia"
          value={formData.materia}
          onChange={handleChange}
        >
          <option value="">Seleccione una Materia</option>
          <option value="Introducción a la programación">Introducción a la programación</option>
          <option value="Cálculo I">Cálculo I</option>
          <option value="Álgebra I">Álgebra I</option>
          <option value="Inglés I">Inglés I</option>
          <option value="Física general">Física general</option>
        </select>
      </div>
      <div className="form-group">
        <label htmlFor="rol">Rol:</label>
        <select
          id="rol"
          name="rol"
          value={formData.rol}
          onChange={handleChange}
        >
          <option value="">Seleccione un rol</option>
          <option value="admin">Docente</option>
          <option value="user">Auxiliar</option>
        </select>
      </div>
      <div className="form-group">
        <label htmlFor="grupo">Grupo:</label>
        <select
          id="grupo"  
          name="grupo"
          value={formData.grupo}
          onChange={handleChange}
        >
          <option value="">Seleccione un Grupo</option>
          <option value="1">Grupo 1</option>
          <option value="2">Grupo 2</option>
          <option value="3">Grupo 3</option>
          <option value="4">Grupo 4</option>
        </select>
      </div>
      <button type="submit">Registrar</button>
    </form>
  );
};

export default RegistrarPersonalForm;

// src/components/ActualizarPersonal.jsx

import React, { useState } from 'react';
import './ActualizarPersonal.css';
import { actualizarPersonal } from '../../services/ActualizarPersonalService';

function ActualizarPersonal() {
  // Estados para almacenar los datos del formulario
  const [id, setId] = useState('');
  const [name, setName] = useState('');
  const [email, setEmail] = useState('');
  const [telefono, setTelefono] = useState('');
  const [estado, setEstado] = useState('');
  const [tipoPersonalId, setTipoPersonalId] = useState('');
  const [mensaje, setMensaje] = useState('');

  // Función para manejar el envío del formulario
  const handleSubmit = async (event) => {
    event.preventDefault();

    // Crear un objeto con los datos del formulario
    const personalData = {
      name: name,
      email: email,
      telefono: telefono,
      estado: estado,
      tipo_personal_id: tipoPersonalId,
    };

    try {
      // Llamar a la función del servicio para actualizar el personal
      const response = await actualizarPersonal(id, personalData);
      setMensaje('Personal académico actualizado exitosamente.');
      console.log('Respuesta del servidor:', response);
    } catch (error) {
      setMensaje('Hubo un error al actualizar el personal académico.');
      console.error('Error al hacer la solicitud:', error);
    }
  };

  return (
    <div className="container">
      <h1>Actualizar Personal Académico</h1>
      <form id="personal-form" onSubmit={handleSubmit}>
        {/* <div className="form-group">
          <label htmlFor="id">ID:</label>
          <input
            type="text"
            value={id}
            onChange={(e) => setId(e.target.value)}
            required
            placeholder="ID del personal"
          />
        </div> */}
        <div className="form-group">
          <label htmlFor="name">Nombre:</label>
          <input
            type="text"
            value={name}
            onChange={(e) => setName(e.target.value)}
            required
            placeholder="Nombre"
          />
        </div>
        <div className="form-group">
          <label htmlFor="email">Email:</label>
          <input
            type="email"
            value={email}
            onChange={(e) => setEmail(e.target.value)}
            required
            placeholder="Correo electrónico"
          />
        </div>
        <div className="form-group">
          <label htmlFor="telefono">Teléfono:</label>
          <input
            type="text"
            value={telefono}
            onChange={(e) => setTelefono(e.target.value)}
            required
            placeholder="Teléfono"
          />
        </div>
        <div className="form-group">
          <label htmlFor="estado">Estado:</label>
          <input
            type="text"
            value={estado}
            onChange={(e) => setEstado(e.target.value)}
            required
            placeholder="Estado"
          />
        </div>
        <div className="form-group">
          <label htmlFor="tipoPersonalId">Tipo Personal ID:</label>
          <input
            type="text"
            value={tipoPersonalId}
            onChange={(e) => setTipoPersonalId(e.target.value)}
            required
            placeholder="ID del tipo de personal"
          />
        </div>
        <button type="submit" className="btn">
          Actualizar
        </button>
      </form>
      {/* Mostrar mensaje de éxito o error */}
      {mensaje && <p>{mensaje}</p>}
    </div>
  );
}

export default ActualizarPersonal;
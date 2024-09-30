import React, { useState } from 'react';
import axios from 'axios';
import './ActualizarPersonal.css'; // Importa la hoja de estilos
import fetchHealthStatus from '../../services/healthService.js';

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
  const handleSubmit = (event) => {
    event.preventDefault();

    // Crear un objeto con los datos del formulario
    const personalData = {
      name: name,
      email: email,
      telefono: telefono,
      estado: estado,
      tipo_personal_id: tipoPersonalId,
    };

    // Hacer la solicitud PUT a la API de Laravel
    axios
      .put(`http://127.0.0.1:8000/api/personal-academico/${id}`, personalData)
      .then((response) => {
        setMensaje('Personal académico actualizado exitosamente.');
        console.log('Respuesta del servidor:', response.data);
      })
      .catch((error) => {
        setMensaje('Hubo un error al actualizar el personal académico.');
        console.error('Error al hacer la solicitud:', error);
      });
  };

  return (
    <div class="container">
    <h1>Actualizar Personal Académico</h1>
    <form id="personal-form" onSubmit={handleSubmit}>
        <div class="form-group">
            <label for="id">ID:</label>
            <input  type="text"
                    value={id}
                    onChange={(e) => setId(e.target.value)}
                    required
                    placeholder="ID del personal"/>
        </div>
        <div class="form-group">
            <label for="name">Nombre:</label>
            <input  type="text"
                    value={name}
                    onChange={(e) => setName(e.target.value)}
                    required
                    placeholder="Nombre" />
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input  type="email"
                    value={email}
                    onChange={(e) => setEmail(e.target.value)}
                    required
                    placeholder="Correo electrónico" />
        </div>
        <div class="form-group">
            <label for="telefono">Teléfono:</label>
            <input  type="text"
                    value={telefono}
                    onChange={(e) => setTelefono(e.target.value)}
                    required
                    placeholder="Teléfono" />
        </div>
        <div class="form-group">
            <label for="estado">Estado:</label>
            <input  type="text"
                    value={estado}
                    onChange={(e) => setEstado(e.target.value)}
                    required
                    placeholder="Estado" />
        </div>
        <div class="form-group">
            <label for="tipoPersonalId">Tipo Personal ID:</label>
            <input type="text"
                    value={tipoPersonalId}
                    onChange={(e) => setTipoPersonalId(e.target.value)}
                    required
                    placeholder="ID del tipo de personal" />
        </div>
        <button type="submit" class="btn">Actualizar</button>
    </form>
    {/* Mostrar mensaje de éxito o error */}
    {mensaje && <p>{mensaje}</p>}
    
</div>
  );
}

export default ActualizarPersonal;
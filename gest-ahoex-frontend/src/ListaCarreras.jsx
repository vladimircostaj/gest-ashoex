import React, { useEffect, useState } from 'react';
import axios from 'axios';

const ListaCarreras = () => {
  const [carreras, setCarreras] = useState([]);
  const [error, setError] = useState(null);

  useEffect(() => {
    // Realiza la solicitud al backend
    axios.get('http://localhost:8000/carreras')
      .then(response => {
        setCarreras(response.data); // Guarda los datos en el estado
        console.log("Carreras obtenidas:", response.data);
      })
      .catch(error => {
        setError(error); // Manejo de errores
        console.error("Hubo un error al obtener las carreras:", error);
      });
  }, []); // Se ejecuta una vez al montar el componente

  if (error) {
    return <div>Error al cargar las carreras: {error.message}</div>;
  }

  return (
    <div>
      <h1>Lista de Carreras</h1>
      <ul>
        {carreras.map(carrera => (
          <li key={carrera.id}>{carrera.nombre}</li>
        ))}
      </ul>
    </div>
  );
};

export default ListaCarreras;

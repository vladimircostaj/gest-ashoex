import React, { useEffect, useState } from 'react';
import axios from 'axios';

const ListaCarreras = () => {
  const [carreras, setCarreras] = useState([]);
  const [error, setError] = useState(null);

  useEffect(() => {
    axios.get('http://localhost:8000/api/carreras')
      .then(response => {
        setCarreras(response.data);
        console.log("Carreras obtenidas:", response.data);
      })
      .catch(error => {
        setError(error);
        console.error("Hubo un error al obtener las carreras:", error);
      });
  }, []); 

  if (error) {
    return <h1>Error al cargar las carreras: {error.message}</h1>;
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

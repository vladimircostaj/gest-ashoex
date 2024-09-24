import React, { useEffect, useState } from 'react';
import axios from 'axios';
import 'bootstrap/dist/css/bootstrap.min.css'; // Asegúrate de importar el archivo CSS de Bootstrap si no lo has hecho

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
    <div className="container mt-4">
      <h1 className="text-center mb-4">Lista de Carreras</h1>
      <table className="table table-striped table-bordered">
        <thead className="thead-dark">
          <tr>
            <th>ID</th>
            <th>Nombre</th>
          </tr>
        </thead>
        <tbody>
          {carreras.map(carrera => (
            <tr key={carrera.id}>
              <td>{carrera.id}</td>
              <td>{carrera.nombre}</td>
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  );
};

export default ListaCarreras;

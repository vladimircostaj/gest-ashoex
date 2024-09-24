import React, { useState, useEffect } from 'react';
import './ListaPersonalAcademico.css';

function ListaPersonalAcademico() {
  const [listaPersonalAcademico, setListaPersonalAcademico] = useState([]); // Cambié el nombre a minúsculas por convención

  useEffect(() => {
    fetch('http://localhost:8000/api/ListaPersonalAcademico')
      .then((response) => {
        if (!response.ok) {
          throw new Error('Error al obtener los datos');
        }
        return response.json();
      })
      .then((data) => {
        console.log(data);
        setListaPersonalAcademico(data); // Actualiza el estado correctamente
      })
      .catch((error) => {
        console.error(error);
      });
  }, []);

  return (
    <div className="containerDoss" style={{ minHeight: '78.7vh' }}>
      <div className='encabezados'>
        <div className='contenidoss'>
          <h2 className='titulolistas'>Personal Académico Registrado:</h2>
        </div>
      </div>
      <div className='tabla-contenedor'>
        <table className="table table-hover">
          <thead className="thead">
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Email</th>
              <th>Teléfono</th>
              <th>Tipo Personal</th>
              <th>Carga Horaria</th>
            </tr>
          </thead>
          <tbody>
            {listaPersonalAcademico.map((personal) => (
              <tr key={personal.personal_academico_id} className="fila-lista">
                <td>{personal.personal_academico_id}</td>
                <td>{personal.nombre}</td>
                <td>{personal.email}</td>
                <td>{personal.telefono}</td>
                <td>{personal.Tipo_personal}</td>
                <td>{personal.carga_horaria}</td>
              </tr>
            ))}
          </tbody>
        </table>
      </div>
    </div>
  );
}

export default ListaPersonalAcademico;

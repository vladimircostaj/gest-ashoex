import React, { useState, useEffect } from 'react';
import './ListaPersonalAcademico.css';
import  ApiListaPersonalAcademico from  '../../services/ListaPersonalAcademico.js'
function ListaPersonalAcademico() {
  const [listaPersonalAcademico, setListaPersonalAcademico] = useState([]);

  useEffect(() => {
    const obtenerDatos = async () => {
      try {
        const data = await ApiListaPersonalAcademico();
        console.log("datos", data);
        setListaPersonalAcademico(data);
      } catch (error) {
        console.error(error);
      }
    };

    obtenerDatos();
  }, []);

  const Editar = (personal) => {
  };

  const Borrar = (personalId) => {
  };

  return (
    <div className="containerDoss" style={{ minHeight: '100vh' }}>
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
              <th>Estado</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            {listaPersonalAcademico.map((personal) => (
              <tr key={personal.personal_academico_id} className="fila-lista">
                <td>{personal.personal_academico_id}</td>
                <td>{personal.name}</td>
                <td>{personal.email}</td>
                <td>{personal.telefono}</td>
                <td>{personal.Tipo_personal}</td>
                <td>{personal.estado}</td>
                <td>
                  <button onClick={() => Editar(personal)} className="btn btn-primary">Editar</button>
                  <button onClick={() => Borrar(personal.personal_academico_id)} className="btn btn-danger">Eliminar</button>
                </td>
              </tr>
            ))}
          </tbody>
        </table>
      </div>
    </div>
  );
}

export default ListaPersonalAcademico;
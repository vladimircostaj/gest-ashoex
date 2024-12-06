import { useState } from "react";
import { FaEdit, FaTrash } from "react-icons/fa";
import "./listar_curricula.css";
import Title from "../../components/typography/title";
import { Link } from "react-router-dom";


const ListarCurriculas = () => {
  // Lista de currículas estática
  const curriculas = [
    {
      id: 1,
      carrera: "Ingeniería en Sistemas",
      materia: "Matemáticas I",
      nivel: "1",
      esElectiva: "No",
    },
    {
      id: 2,
      carrera: "Ingeniería Civil",
      materia: "Física General",
      nivel: "2",
      esElectiva: "Sí",
    },
    {
      id: 3,
      carrera: "Arquitectura",
      materia: "Dibujo Técnico",
      nivel: "3",
      esElectiva: "No",
    },
  ];

  return (
    <div className="container mt-5">
      <div className="table title">
        <div className="row">
          <div className="">
            <Title text={"Listado de Currículas"}></Title>
          </div>
        </div>
      </div>
      <table className="table table-striped table-hover">
        <thead>
          <tr>
            <th># ID</th>
            <th>Carrera</th>
            <th>Materia</th>
            <th>Nivel</th>
            <th>Electiva</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          {curriculas.map((curricula) => (
            <tr key={curricula.id}>
              <td>{curricula.id}</td>
              <td>{curricula.carrera}</td>
              <td>{curricula.materia}</td>
              <td>{curricula.nivel}</td>
              <td>{curricula.esElectiva}</td>
              <td>
                <Link
                  to={`/editar-curricula/${curricula.id}`}
                  className="edit mr-6 ml-6"
                >
                  <FaEdit />
                </Link>

                {/*
                <Link
                  to={`/registrar-grupo/${curricula.id}`}
                  className="edit mr-6 ml-6"
                >
                  <FaEdit />
                </Link>
                
                */}
                
                <a href="#" className="delete mr-6 ml-6">
                  <FaTrash />
                </a>
              </td>
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  );
};

export default ListarCurriculas;

import React, { useState, useEffect } from "react";
import axios from "axios";
import "./listar_ambientes.css";
import Title from "../../components/typography/title";
import { Link } from "react-router-dom";
import { FaEdit, FaTrash } from "react-icons/fa";

const ListaUsos = () => {
  const [usos, setUsos] = useState([]);

  const fetchUsos = async () => {
    try {
      const response = await axios.get("http://127.0.0.1:8000/api/usos");
      console.log("Datos obtenidos de la API:", response.data);
      setUsos(response.data.data); 
    } catch (error) {
      console.error("Error al obtener los datos de la API:", error);
    }
  };

  // Llamada a la API al cargar el componente
  useEffect(() => {
    fetchUsos();
  }, []);

  return (
    <div className="container mt-5">
      <div className="table title">
        <div className="row">
          <div>
            <Title text={"Listado de Usos"}></Title>
          </div>
        </div>
      </div>
      <table className="table table-striped table-hover">
        <thead>
          <tr>
            <th>ID</th>
            <th>Tipo de Uso</th>
          </tr>
        </thead>
        <tbody>
          {usos.length > 0 ? (
            usos.map((uso) => (
              <tr key={uso.id_uso}>
                <td>{uso.id_uso}</td>
                <td>{uso.tipo_uso}</td>
              </tr>
            ))
          ) : (
            <tr>
              <td colSpan="3">No hay datos disponibles</td>
            </tr>
          )}
        </tbody>
      </table>
    </div>
  );
};

export default ListaUsos;

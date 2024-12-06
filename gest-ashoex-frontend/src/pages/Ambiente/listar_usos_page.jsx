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

  // Función para manejar la eliminación
  const handleDelete = async (id_uso) => {
    const confirm = window.confirm(
      "¿Estás seguro de que deseas eliminar este uso?"
    );
    if (confirm) {
      try {
        await axios.delete(`http://127.0.0.1:8000/api/usos/${id_uso}`);
        // Actualizar la lista eliminando el uso
        setUsos(usos.filter((uso) => uso.id_uso !== id_uso));
        alert("El uso ha sido eliminado correctamente.");
      } catch (error) {
        console.error("Error al eliminar el uso:", error);
        alert("Hubo un error al eliminar el uso.");
      }
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
                <td>
                  <a
                    //href="#"
                    className="delete mr-6 ml-6"
                    onClick={() => handleDelete(uso.id_uso)}
                  >
                    <FaTrash />
                  </a>
                </td>
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

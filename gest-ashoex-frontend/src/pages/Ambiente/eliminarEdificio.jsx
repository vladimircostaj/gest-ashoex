import React, { useState, useEffect } from "react";
import axios from "axios";
import "./listar_ambientes.css";
import Title from "../../components/typography/title";
import { FaTrash } from "react-icons/fa";

const EliminarEdificios = () => {
  const [edificios, setEdificios] = useState([]);

  const fetchEdificios = async () => {
    try {
      const response = await axios.get("http://127.0.0.1:8000/api/edificios");
      console.log("Datos obtenidos de la API:", response.data);
      if (response.data.success) {
        setEdificios(response.data.data); // Accede al array de edificios dentro de la propiedad 'data'
      } else {
        console.error("Error en la respuesta del servidor:", response.data.message);
      }
    } catch (error) {
      console.error("Error al obtener los datos de la API:", error);
    }
  };

  const handleDelete = async (id_edificio) => {
    const confirm = window.confirm(
      "¿Estás seguro de que deseas eliminar este edificio?"
    );
    if (confirm) {
      try {
        await axios.delete(`http://127.0.0.1:8000/api/edificios/${id_edificio}`);
        setEdificios(edificios.filter((edificio) => edificio.id_edificio !== id_edificio));
        alert("El edificio ha sido eliminado correctamente.");
      } catch (error) {
        console.error("Error al eliminar el edificio:", error);
        alert("Hubo un error al eliminar el edificio.");
      }
    }
  };

  useEffect(() => {
    fetchEdificios();
  }, []);

  return (
    <div className="container mt-5">
      <div className="table title">
        <div className="row">
          <div>
            <Title text={"Listado de Edificios"} />
          </div>
        </div>
      </div>
      <table className="table table-striped table-hover" style={{marginLeft:'300px'}}>
        <thead>
          <tr>
            <th>ID</th>
            <th>Nombre del Edificio</th>
            <th>Geolocalización</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          {edificios.length > 0 ? (
            edificios.map((edificio) => (
              <tr key={edificio.id_edificio}>
                <td>{edificio.id_edificio}</td>
                <td>{edificio.nombre_edificio}</td>
                <td>{edificio.geolocalizacion}</td>
                <td>
                  <a
                    className="delete"
                    onClick={() => handleDelete(edificio.id_edificio)}
                  >
                    <FaTrash />
                  </a>
                </td>
              </tr>
            ))
          ) : (
            <tr>
              <td colSpan="4">No hay datos disponibles</td>
            </tr>
          )}
        </tbody>
      </table>
    </div>
  );
};

export default EliminarEdificios;

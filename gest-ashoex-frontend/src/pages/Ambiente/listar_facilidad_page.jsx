import React, { useState, useEffect } from "react";
import axios from "axios";
import "./listar_ambientes.css";
import "./modal.css";
import Title from "../../components/typography/title";
import { FaEdit } from "react-icons/fa";
import EditarModal from "./modal_editar";

const ListaFacilidades = () => {
  const [facilidades, setFacilidades] = useState([]);
  const [modalIsOpen, setModalIsOpen] = useState(false);
  const [selectedFacilidad, setSelectedFacilidad] = useState(null);
  const [formData, setFormData] = useState({ nombre_facilidad: "" });
  const [error, setError] = useState("");

  const fetchFacilidades = async () => {
    try {
      const response = await axios.get("http://127.0.0.1:8000/api/facilidades");
      console.log("Datos obtenidos de la API:", response.data);
      setFacilidades(response.data.data);
    } catch (error) {
      console.error("Error al obtener los datos de la API:", error);
    }
  };

  // Llamada a la API al cargar el componente
  useEffect(() => {
    fetchFacilidades();
  }, []);

  const openModal = (facilidad) => {
    setFormData({
        id_facilidad: facilidad.id_facilidad,
        nombre_facilidad: facilidad.nombre_facilidad,
      });
    setModalIsOpen(true);
  };

  const closeModal = () => {
    setModalIsOpen(false);
    setSelectedFacilidad(null);
    setFormData({ nombre_facilidad: "" });
    setError("");
  };

  // Función para manejar los cambios en el campo
  const handleChange = (e) => {
    setFormData({ ...formData, [e.target.name]: e.target.value });
  };

  // Función para guardar los cambios
  const handleSave = async () => {
    if (!formData.nombre_facilidad.trim()) {
      setError("Este campo es obligatorio.");
      return;
    }

    try {
        await axios.put(
          `http://127.0.0.1:8000/api/facilidades/${selectedFacilidad.id_facilidad}`,
          { nombre_facilidad: formData.nombre_facilidad }
        );
        // Actualizar la lista después de editar
        fetchFacilidades();
        closeModal();
      } catch (error) {
        console.error("Error al actualizar la facilidad:", error);
      }
    };

  return (
    <div className="container mt-5">
      <div className="table title">
        <div className="row">
          <div>
            <Title text={"Listado de Facilidades"}></Title>
          </div>
        </div>
      </div>
      <table className="table table-striped table-hover">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nombre de la Facilidad</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          {facilidades.length > 0 ? (
            facilidades.map((facilidad) => (
              <tr key={facilidad.id_facilidad}>
                <td>{facilidad.id_facilidad}</td>
                <td>{facilidad.nombre_facilidad}</td>
                <td>
                  <button
                    onClick={() => openModal(facilidad)}
                    className="edit mr-6 ml-6"
                  >
                    <FaEdit />
                  </button>
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
      <EditarModal
        isOpen={modalIsOpen}
        onRequestClose={closeModal}
        title="Editar"
        formData={formData}
        handleChange={handleChange}
        handleSave={handleSave}
        error={error}
      />
    </div>
  );
};

export default ListaFacilidades;
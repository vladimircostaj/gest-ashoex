import React, { useState } from "react";
import "./lista-carreras.css";

const ListaCarreras = () => {
  // Datos de ejemplo estáticos
  const [carreras, setCarreras] = useState([
    { codigo: "ING001", nombre: "Ingeniería de Sistemas", duracion: 5 },
    { codigo: "ADM002", nombre: "Administración de Empresas", duracion: 4 },
    { codigo: "MED003", nombre: "Medicina", duracion: 6 },
    { codigo: "DER004", nombre: "Derecho", duracion: 5 },
  ]);

  const [searchTerm, setSearchTerm] = useState("");
  const [editData, setEditData] = useState(null); // Carrera a editar
  const [showEditModal, setShowEditModal] = useState(false);

  const handleSearchChange = (e) => {
    setSearchTerm(e.target.value.toLowerCase());
  };

  const filteredCarreras = carreras.filter((carrera) =>
    Object.values(carrera)
      .join(" ")
      .toLowerCase()
      .includes(searchTerm)
  );

  const handleDelete = (codigo) => {
    const confirmDelete = window.confirm(
      "¿Estás seguro de que deseas eliminar esta carrera?"
    );
    if (confirmDelete) {
      setCarreras(carreras.filter((carrera) => carrera.codigo !== codigo));
    }
  };

  const handleEdit = (carrera) => {
    setEditData(carrera);
    setShowEditModal(true);
  };

  const handleEditSave = () => {
    setCarreras((prevCarreras) =>
      prevCarreras.map((carrera) =>
        carrera.codigo === editData.codigo ? editData : carrera
      )
    );
    setShowEditModal(false);
  };

  return (
    <div className="lista-carreras-container">
      <h2 className="table-title">Lista de Carreras</h2>
      <input
        type="text"
        className="search-input"
        placeholder="Buscar por código o nombre..."
        value={searchTerm}
        onChange={handleSearchChange}
      />
      <table className="carreras-table">
        <thead>
          <tr>
            <th>Código</th>
            <th>Nombre</th>
            <th>Duración (años)</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          {filteredCarreras.length > 0 ? (
            filteredCarreras.map((carrera, index) => (
              <tr key={index}>
                <td>{carrera.codigo}</td>
                <td>{carrera.nombre}</td>
                <td>{carrera.duracion}</td>
                <td>
                  <button
                    className="edit-btn"
                    onClick={() => handleEdit(carrera)}
                  >
                    Editar
                  </button>
                  <button
                    className="delete-btn"
                    onClick={() => handleDelete(carrera.codigo)}
                  >
                    Eliminar
                  </button>
                </td>
              </tr>
            ))
          ) : (
            <tr>
              <td colSpan="4" className="no-results">
                No se encontraron resultados
              </td>
            </tr>
          )}
        </tbody>
      </table>

      {/* Modal para editar */}
      {showEditModal && (
        <div className="modal">
          <div className="modal-content">
            <h3>Editar Carrera</h3>
            <label>
              Código:
              <input
                type="text"
                value={editData.codigo}
                readOnly
              />
            </label>
            <label>
              Nombre:
              <input
                type="text"
                value={editData.nombre}
                onChange={(e) =>
                  setEditData({ ...editData, nombre: e.target.value })
                }
              />
            </label>
            <label>
              Duración (años):
              <input
                type="number"
                value={editData.duracion}
                onChange={(e) =>
                  setEditData({
                    ...editData,
                    duracion: e.target.value,
                  })
                }
              />
            </label>
            <div className="modal-actions">
              <button onClick={handleEditSave}>Guardar</button>
              <button onClick={() => setShowEditModal(false)}>Cancelar</button>
            </div>
          </div>
        </div>
      )}
    </div>
  );
};

export default ListaCarreras;

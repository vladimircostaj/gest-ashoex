import { useState, useEffect } from "react";
import "./listar_ambientes.css";
import ModalEditar from "./modal_editar";

const TablaAmbientes = () => {
  const [ambientes, setAmbientes] = useState([]);
  const [modalVisible, setModalVisible] = useState(false);
  const [selectedAmbiente, setSelectedAmbiente] = useState(null);

  useEffect(() => {
    const fetchData = async () => {
      const data = [
        {
          id: 1,
          numero_aula: "A101",
          capacidad: 30,
          habilitada: true,
          ubicacion: "Edificio Central",
          uso: "Clases",
          facilidades: ["Proyector", "Aire acondicionado"],
        },
        {
          id: 2,
          numero_aula: "B202",
          capacidad: 50,
          habilitada: false,
          ubicacion: "Anexo Sur",
          uso: "Conferencias",
          facilidades: ["Proyector", "Wi-Fi"],
        },
      ];
      setAmbientes(data);
    };

    fetchData();
  }, []);

  const handleEdit = (ambiente) => {
    setSelectedAmbiente(ambiente);
    setModalVisible(true);
  };

  const handleDelete = (id) => {
    setAmbientes(ambientes.filter((ambiente) => ambiente.id !== id));
  };

  return (
    <div className="tabla-container">
      <h2 className="tabla-title">Lista de Aulas</h2>
      <table className="tabla">
        <thead>
          <tr>
            <th>#</th>
            <th>Número de Aula</th>
            <th>Capacidad</th>
            <th>Habilitada</th>
            <th>Ubicación</th>
            <th>Uso</th>
            <th>Facilidades</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          {ambientes.map((ambiente, index) => (
            <tr key={ambiente.id}>
              <td>{index + 1}</td>
              <td>{ambiente.numero_aula}</td>
              <td>{ambiente.capacidad}</td>
              <td>
                {ambiente.habilitada ? (
                  <span className="badge success">Sí</span>
                ) : (
                  <span className="badge danger">No</span>
                )}
              </td>
              <td>{ambiente.ubicacion}</td>
              <td>{ambiente.uso}</td>
              <td>
                {ambiente.facilidades && ambiente.facilidades.length > 0
                  ? ambiente.facilidades.join(", ")
                  : "Sin facilidades"}
              </td>
              <td>
                <button onClick={() => handleEdit(ambiente)}>Editar</button>
                <button onClick={() => handleDelete(ambiente.id)}>
                  Eliminar
                </button>
              </td>
            </tr>
          ))}
        </tbody>
      </table>
      {modalVisible && (
        <ModalEditar
          ambiente={selectedAmbiente}
          onClose={() => setModalVisible(false)}
        />
      )}
    </div>
  );
};

export default TablaAmbientes;

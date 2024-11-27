import "./modal_editar.css";

const ModalEditar = ({ ambiente, onClose }) => {
  // const [editedAmbiente, setEditedAmbiente] = useState({ ...ambiente });

  // const handleChange = (e) => {
  //   const { name, value } = e.target;
  //   setEditedAmbiente({ ...editedAmbiente, [name]: value });
  // };

  // const handleSubmit = (e) => {
  //   e.preventDefault();
  //   console.log("Ambiente editado:", editedAmbiente);
  //   onClose();
  // };

  return (
    <div className="modal-overlay">
      <div className="modal-container">
        <button className="modal-close" onClick={onClose}>
          &times;
        </button>
        <h2>Editar Ambiente</h2>
        {/* <form onSubmit={handleSubmit}>
          <label>
            Número de Aula:
            <input
              type="text"
              name="numero_aula"
              value={editedAmbiente.numero_aula}
              onChange={handleChange}
            />
          </label>
          <label>
            Capacidad:
            <input
              type="number"
              name="capacidad"
              value={editedAmbiente.capacidad}
              onChange={handleChange}
            />
          </label>
          <label>
            Habilitada:
            <input
              type="checkbox"
              name="habilitada"
              checked={editedAmbiente.habilitada}
              onChange={(e) =>
                handleChange({
                  target: { name: "habilitada", value: e.target.checked },
                })
              }
            />
          </label>
          <label>
            Ubicación:
            <input
              type="text"
              name="ubicacion"
              value={editedAmbiente.ubicacion}
              onChange={handleChange}
            />
          </label>
          <label>
            Uso:
            <input
              type="text"
              name="uso"
              value={editedAmbiente.uso}
              onChange={handleChange}
            />
          </label>
          <label>
            Facilidades:
            <input
              type="text"
              name="facilidades"
              value={editedAmbiente.facilidades.join(", ")}
              onChange={(e) =>
                handleChange({
                  target: {
                    name: "facilidades",
                    value: e.target.value.split(", "),
                  },
                })
              }
            />
          </label>
          <button type="submit">Guardar</button>
        </form> */}
      </div>
    </div>
  );
};

export default ModalEditar;

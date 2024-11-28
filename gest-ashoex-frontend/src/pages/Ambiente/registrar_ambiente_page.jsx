import { useState } from "react";
// import { registrarAmbiente } from "../../services/registrar_ambiente_api";

const RegistrarAmbienteForm = () => {
  const [formData, setFormData] = useState({
    numero_aula: "",
    capacidad: "",
    habilitada: false,
    id_ubicacion: "",
    id_uso: "",
    facilidades: [],
  });

  const [disponibles, setDisponibles] = useState({
    ubicaciones: [],
    usos: [],
    facilidades: [],
  });

  const handleChange = (e) => {
    const { name, value, type, checked } = e.target;

    if (type === "checkbox") {
      // Manejo de checkboxes para facilidades
      const updatedFacilidades = checked
        ? [...formData.facilidades, value]
        : formData.facilidades.filter((id) => id !== value);

      setFormData({
        ...formData,
        facilidades: updatedFacilidades,
      });
    } else if (type === "number") {
      setFormData({
        ...formData,
        [name]: Number(value),
      });
    } else if (type === "radio") {
      setFormData({
        ...formData,
        [name]: checked,
      });
    } else {
      setFormData({
        ...formData,
        [name]: value,
      });
    }
  };

  // Manejar el envío del formulario
  const handleSubmit = async (e) => {};

  return (
    <div className="container mt-5">
      <h1 className="mb-4">Registro de Ambiente</h1>
      <form className="form" onSubmit={handleSubmit}>
        <div className="mb-3">
          <label htmlFor="numero_aula" className="form-label">
            Número del Aula:
          </label>
          <input
            type="text"
            id="numero_aula"
            name="numero_aula"
            className="form-control"
            value={formData.numero_aula}
            onChange={handleChange}
            required
          />
        </div>

        <div className="mb-3">
          <label htmlFor="capacidad" className="form-label">
            Capacidad:
          </label>
          <input
            type="number"
            id="capacidad"
            name="capacidad"
            className="form-control"
            value={formData.capacidad}
            onChange={handleChange}
            max={400}
            required
          />
        </div>

        <div className="mb-3">
          <label htmlFor="id_ubicacion" className="form-label">
            Ubicación:
          </label>
          <select
            id="id_ubicacion"
            name="id_ubicacion"
            className="form-select"
            value={formData.id_ubicacion}
            onChange={handleChange}
            required
          >
            <option value="">Seleccione una ubicación</option>
            {disponibles.ubicaciones.map((ubicacion) => (
              <option key={ubicacion.id} value={ubicacion.id}>
                {ubicacion.nombre}
              </option>
            ))}
          </select>
        </div>

        <div className="mb-3">
          <label htmlFor="id_uso" className="form-label">
            Uso:
          </label>
          <select
            id="id_uso"
            name="id_uso"
            className="form-select"
            value={formData.id_uso}
            onChange={handleChange}
            required
          >
            <option value="">Seleccione un uso</option>
            {disponibles.usos.map((uso) => (
              <option key={uso.id} value={uso.id}>
                {uso.nombre}
              </option>
            ))}
          </select>
        </div>

        <div className="mb-3">
          <label htmlFor="facilidad" className="form-label">
            Facilidades:
          </label>
          <select
            name="facilidades"
            id="facilidad"
            className="form-select"
            onChange={handleChange}
            value={formData.facilidades}
            required
          >
            <option value="">Seleccione una facilidad</option>
            {disponibles.facilidades.map((facilidad) => (
              <option key={facilidad.id} value={facilidad.id}>
                {facilidad.nombre}
              </option>
            ))}
          </select>
        </div>

        <button type="submit" className="btn btn-primary">
          Registrar Ambiente
        </button>
      </form>
    </div>
  );
};

export default RegistrarAmbienteForm;

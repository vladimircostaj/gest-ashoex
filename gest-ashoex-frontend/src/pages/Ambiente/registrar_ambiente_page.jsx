import { useState } from "react";
import "./registrar_ambiente.css";
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

  // Manejar cambios en los campos
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
  const handleSubmit = async (e) => {
    e.preventDefault();
    try {
      const response = await registrarAmbiente(formData);
      console.log("Ambiente registrado con éxito:", response);
    } catch (error) {
      console.error("Error al registrar ambiente:", error);
    }
  };

  return (
    <div>
      <h1>Registro de Ambiente</h1>
      <form className="form" onSubmit={handleSubmit}>
        <div className="form-group">
          <label htmlFor="numero_aula">Número del Aula:</label>
          <input
            type="text"
            id="numero_aula"
            name="numero_aula"
            value={formData.numero_aula}
            onChange={handleChange}
            required
          />
        </div>

        <div className="form-group">
          <label htmlFor="capacidad">Capacidad:</label>
          <input
            type="number"
            id="capacidad"
            name="capacidad"
            value={formData.capacidad}
            onChange={handleChange}
            max={400}
            required
          />
        </div>

        <div className="form-group">
          <label htmlFor="id_ubicacion">Ubicación:</label>
          <select
            id="id_ubicacion"
            name="id_ubicacion"
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

        <div className="form-group">
          <label htmlFor="id_uso">Uso:</label>
          <select
            id="id_uso"
            name="id_uso"
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

        <div className="form-group">
          <label>Facilidades:</label>
          <select
            name="facilidades"
            id="facilidad"
            onChange={handleChange}
            value={formData.facilidades}
            required
          >
            <option value=""> Selecciona una facilidad </option>
            {disponibles.facilidades.map((facilidad) => (
              <option key={facilidad.id} value={facilidad.id}>
                {facilidad.nombre}
              </option>
            ))}
          </select>
        </div>
        <button type="submit">Registrar Ambiente</button>
      </form>
    </div>
  );
};

export default RegistrarAmbienteForm;

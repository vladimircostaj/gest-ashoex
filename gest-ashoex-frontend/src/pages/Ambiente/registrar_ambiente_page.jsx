import { useState } from "react";
import Title from "../../components/typography/title";
import InputField from "../../components/form/inputField";
import SelectField from "../../components/form/selectField";
import SaveButton from "../../components/buttons/saveButton";
import CancelButton from "../../components/buttons/cancelButton";
import "./registrar_ambiente.css"; // Importa el archivo CSS

const RegistrarAmbienteForm = () => {
  const [formData, setFormData] = useState({
    numero_aula: "",
    capacidad: "",
    id_ubicacion: "",
    id_uso: "",
    facilidades: "",
  });

  const [disponibles, setDisponibles] = useState({
    ubicaciones: [],
    usos: [],
    facilidades: [],
  });

  const handleChange = (e) => {
    const { name, value } = e.target;
    setFormData({
      ...formData,
      [name]: value,
    });
  };

  const handleCancel = () => {
    console.log("Registro cancelado");
  };

  const handleSave = () => {
    console.log("Datos guardados:", formData);
  };

  return (
    <div className="form-container">
      <div className="card form-card">
        <div className="mb-3 text-center">
          <Title text="Registrar Ambientes" />
        </div>

        <form className="d-flex flex-column gap-3">
          <InputField
            label="Número del Aula:"
            id="numero_aula"
            placeholder="Ingrese el número del aula"
            value={formData.numero_aula}
            onChange={handleChange}
            style={{
              container: { textAlign: "left" },
              input: { width: "100%" },
            }}
          />

          <InputField
            label="Capacidad:"
            id="capacidad"
            type="number"
            placeholder="Ingrese la capacidad"
            value={formData.capacidad}
            onChange={handleChange}
            style={{
              container: { textAlign: "left" },
              input: { width: "100%" },
            }}
          />

          <SelectField
            label="Ubicación:"
            id="id_ubicacion"
            options={[
              { value: "", label: "Seleccione una ubicación" },
              ...disponibles.ubicaciones.map((ubicacion) => ({
                value: ubicacion.id,
                label: ubicacion.nombre,
              })),
            ]}
            value={formData.id_ubicacion}
            onChange={handleChange}
            style={{
              container: { textAlign: "left" },
              select: { width: "100%" },
            }}
          />

          <SelectField
            label="Uso:"
            id="id_uso"
            options={[
              { value: "", label: "Seleccione un uso" },
              ...disponibles.usos.map((uso) => ({
                value: uso.id,
                label: uso.nombre,
              })),
            ]}
            value={formData.id_uso}
            onChange={handleChange}
            style={{
              container: { textAlign: "left" },
              select: { width: "100%" },
            }}
          />

          <SelectField
            label="Facilidades:"
            id="facilidades"
            options={[
              { value: "", label: "Seleccione una facilidad" },
              ...disponibles.facilidades.map((facilidad) => ({
                value: facilidad.id,
                label: facilidad.nombre,
              })),
            ]}
            value={formData.facilidades}
            onChange={handleChange}
            style={{
              container: { textAlign: "left" },
              select: { width: "100%" },
            }}
          />

          <div className="d-flex justify-content-between gap-2 mt-3">
            <CancelButton onClick={handleCancel} />
            <SaveButton onClick={handleSave} />
          </div>
        </form>
      </div>
    </div>
  );
};

export default RegistrarAmbienteForm;

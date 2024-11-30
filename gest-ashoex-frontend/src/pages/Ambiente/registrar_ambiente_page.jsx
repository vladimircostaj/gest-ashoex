import React, { useState } from "react";
import Title from "../../components/typography/title";
import InputField from "../../components/form/inputField";
import SelectField from "../../components/form/selectField"; // Si tienes este componente
import SaveButton from "../../components/buttons/saveButton"; // Si tienes este componente
import CancelButton from "../../components/buttons/cancelButton"; // Si tienes este componente
import "./registrar_ambiente.css"; // Importa el archivo CSS
import { toast } from "sonner";

const RegistrarAmbienteForm = () => {
  const [formData, setFormData] = useState({
    numero_aula: "",
    capacidad: "",
    id_ubicacion: "",
    id_uso: "",
    facilidades: "",
  });

  const [disponibles, setDisponibles] = useState({
    ubicaciones: [
      { id: 1, nombre: "Edificio A" },
      { id: 2, nombre: "Edificio B" },
    ],
    usos: [
      { id: 1, nombre: "Clase" },
      { id: 2, nombre: "Laboratorio" },
    ],
    facilidades: [
      { id: 1, nombre: "Proyector" },
      { id: 2, nombre: "Aire Acondicionado" },
    ],
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
    setFormData({
      numero_aula: "",
      capacidad: "",
      id_ubicacion: "",
      id_uso: "",
      facilidades: "",
    });
  };

  const handleSave = () => {
    console.log("Datos guardados:", formData);
    toast.success("Ambiente registrado exitosamente");
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
            name="numero_aula"
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
            name="capacidad"
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
            name="id_ubicacion"
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
            name="id_uso"
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
            name="facilidades"
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

import React, { useState } from "react";
import axios from "axios";
import FormCard from "../../components/form/formCard";
import InputField from "../../components/form/inputField";
import SaveButton from "../../components/buttons/saveButton";
import CancelButton from "../../components/buttons/cancelButton";

const RegistrarFacilidad = () => {
  const [formData, setFormData] = useState({
    nombre_facilidad: "",
  });
  const [message, setMessage] = useState("");
  const [isError, setIsError] = useState(false);

  const handleChange = (e) => {
    const { id, value } = e.target;
    setFormData({
      ...formData,
      [id]: value,
    });
    // Limpiar el mensaje y el estado de error al cambiar el valor del campo
    setMessage("");
    setIsError(false);
  };

  const handleCancel = () => {
    setFormData({ nombre_facilidad: "" }); // Limpiar el formulario
    setMessage(""); // Limpiar el mensaje
    setIsError(false); // Limpiar el estado de error
    console.log("Registro cancelado");
  };

  const handleSave = async () => {
    try {
      const response = await axios.post('http://localhost:8000/api/facilidades', formData);
      console.log("Datos guardados:", response.data);
      setFormData({ nombre_facilidad: "" }); // Limpiar el formulario
      setMessage("Facilidad registrada exitosamente");
      setIsError(false);
    } catch (error) {
      console.error("Error al guardar los datos:", error);
      setMessage("Error al registrar la facilidad");
      setIsError(true);
    }
  };

  return (
    <div className="form-container">
      <FormCard>
        <div className="mb-3 text-center">
          <h2>Registrar Facilidad</h2>
        </div>

        <form className="d-flex flex-column gap-3" onSubmit={(e) => e.preventDefault()}>
          <InputField
            label="Nombre de Facilidad:"
            id="nombre_facilidad"
            name="nombre_facilidad"
            placeholder="Ingrese el nombre de la facilidad"
            value={formData.nombre_facilidad}
            onChange={handleChange}
            style={{
              container: { textAlign: "left" },
              input: { width: "100%" },
            }}
          />

          <div className="d-flex justify-content-between gap-2 mt-3">
            <CancelButton onClick={handleCancel} />
            <SaveButton onClick={handleSave} />
          </div>
        </form>

        {message && (
          <div className={`alert ${isError ? 'alert-danger' : 'alert-success'}`} role="alert">
            {message}
          </div>
        )}
      </FormCard>
    </div>
  );
};

export default RegistrarFacilidad;
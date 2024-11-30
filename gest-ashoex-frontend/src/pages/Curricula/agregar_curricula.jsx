import React, { useState } from "react";
import Title from "../../components/typography/title";
import InputField from "../../components/form/inputField";
import SelectField from "../../components/form/selectField";
import SaveButton from "../../components/buttons/saveButton";
import CancelButton from "../../components/buttons/cancelButton";

const AgregarCurriculaPage = () => {
  const [formData, setFormData] = useState({
    id: "",
    idCarrera: "",
    idMateria: "",
    nivel: "",
    electiva: "",
  });

  const [errors, setErrors] = useState({});

  const handleChange = (e) => {
    const { id, value } = e.target;
    setFormData({ ...formData, [id]: value });

    // Elimina el error si el campo no está vacío
    if (value.trim() !== "") {
      setErrors({ ...errors, [id]: "" });
    }
  };

  const handleSave = () => {
    const newErrors = {};

    // Validación de campos obligatorios
    Object.keys(formData).forEach((key) => {
      if (!formData[key].trim()) {
        newErrors[key] = "Campo obligatorio";
      }
    });

    setErrors(newErrors);

    if (Object.keys(newErrors).length === 0) {
      console.log("Guardado:", formData);
    }
  };

  const handleCancel = () => {
    console.log("Registro cancelado");
  };

  return (
    <div className="d-flex justify-content-center align-items-center vh-100 bg-light p-3">
      <div className="card shadow-lg rounded-4 p-4" style={{ maxWidth: "400px", width: "100%" }}>
        <div className="mb-3">
          <Title text="Agregar Currícula" />
        </div>

        <form className="d-flex flex-column gap-4" onSubmit={(e) => e.preventDefault()}>
          {/* ID */}
          <div className="position-relative">
            <InputField
              label={
                <span>
                  ID de Curricula: <span className="text-danger">*</span>
                </span>
              }
              id="id"
              placeholder="Ingrese el ID de la currícula"
              value={formData.id}
              onChange={handleChange}
              style={{
                container: { textAlign: "left" },
                input: { width: "100%" },
              }}
            />
            <div className="text-danger position-absolute" style={{ fontSize: "0.75rem", top: "100%", left: "5px", height: "12px" }}>
              {errors.id}
            </div>
          </div>

          {/* ID de Carrera */}
          <div className="position-relative">
            <InputField
              label={
                <span>
                  ID de Carrera: <span className="text-danger">*</span>
                </span>
              }
              id="idCarrera"
              placeholder="Ingrese el ID de la carrera"
              value={formData.idCarrera}
              onChange={handleChange}
              style={{
                container: { textAlign: "left" },
                input: { width: "100%" },
              }}
            />
            <div className="text-danger position-absolute" style={{ fontSize: "0.75rem", top: "100%", left: "5px", height: "12px" }}>
              {errors.idCarrera}
            </div>
          </div>

          {/* ID de Materia */}
          <div className="position-relative">
            <InputField
              label={
                <span>
                  ID de Materia: <span className="text-danger">*</span>
                </span>
              }
              id="idMateria"
              placeholder="Ingrese el ID de la materia"
              value={formData.idMateria}
              onChange={handleChange}
              style={{
                container: { textAlign: "left" },
                input: { width: "100%" },
              }}
            />
            <div className="text-danger position-absolute" style={{ fontSize: "0.75rem", top: "100%", left: "5px", height: "12px" }}>
              {errors.idMateria}
            </div>
          </div>

          {/* Nivel */}
          <div className="position-relative">
            <InputField
              label={
                <span>
                  Nivel: <span className="text-danger">*</span>
                </span>
              }
              id="nivel"
              type="number"
              placeholder="Ingrese el nivel"
              value={formData.nivel}
              onChange={handleChange}
              style={{
                container: { textAlign: "left" },
                input: { width: "100%" },
              }}
            />
            <div className="text-danger position-absolute" style={{ fontSize: "0.75rem", top: "100%", left: "5px", height: "12px" }}>
              {errors.nivel}
            </div>
          </div>

          {/* Electiva */}
          <div className="position-relative">
            <SelectField
              label={
                <span>
                  Electiva: <span className="text-danger">*</span>
                </span>
              }
              id="electiva"
              value={formData.electiva}
              options={[
                { value: "", label: "Seleccione una opción" },
                { value: "si", label: "Sí" },
                { value: "no", label: "No" },
              ]}
              onChange={handleChange}
              style={{
                container: { textAlign: "left" },
                select: { width: "100%" },
              }}
            />
            <div className="text-danger position-absolute" style={{ fontSize: "0.75rem", top: "100%", left: "5px", height: "12px" }}>
              {errors.electiva}
            </div>
          </div>

          {/* Botones de acción */}
          <div className="d-flex justify-content-between gap-2 mt-3">
            <CancelButton onClick={handleCancel} />
            <SaveButton onClick={handleSave} />
          </div>
        </form>
      </div>
    </div>
  );
};

export default AgregarCurriculaPage;

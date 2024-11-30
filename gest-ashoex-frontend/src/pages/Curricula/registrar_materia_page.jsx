import React, { useState } from "react";
import Title from "../../components/typography/title";
import InputField from "../../components/form/inputField";
import SelectField from "../../components/form/selectField";
import SaveButton from "../../components/buttons/saveButton";
import CancelButton from "../../components/buttons/cancelButton";

const RegistrarMateriaForm = () => {
  const [formData, setFormData] = useState({
    codigo: "",
    nombre: "",
    tipo: "",
    numeroPeriodoAcademico: "",
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
          <Title text="Registrar Materia" />
        </div>

        <form className="d-flex flex-column gap-4" onSubmit={(e) => e.preventDefault()}>
          {/* Código de materia */}
          <div className="position-relative">
            <InputField
              label={
                <span>
                  Código: <span className="text-danger">*</span>
                </span>
              }
              id="codigo"
              placeholder="Ingrese el código de la materia"
              value={formData.codigo}
              onChange={handleChange}
              style={{
                container: { textAlign: "left" },
                input: { width: "100%" },
              }}
            />
            <div className="text-danger position-absolute" style={{ fontSize: "0.75rem", top: "100%", left: "5px", height: "12px" }}>
              {errors.codigo}
            </div>
          </div>

          {/* Nombre de la materia */}
          <div className="position-relative">
            <InputField
              label={
                <span>
                  Nombre: <span className="text-danger">*</span>
                </span>
              }
              id="nombre"
              placeholder="Ingrese el nombre de la materia"
              value={formData.nombre}
              onChange={handleChange}
              style={{
                container: { textAlign: "left" },
                input: { width: "100%" },
              }}
            />
            <div className="text-danger position-absolute" style={{ fontSize: "0.75rem", top: "100%", left: "5px", height: "12px" }}>
              {errors.nombre}
            </div>
          </div>

          {/* Tipo de materia */}
          <div className="position-relative">
            <SelectField
              label={
                <span>
                  Tipo: <span className="text-danger">*</span>
                </span>
              }
              id="tipo"
              value={formData.tipo}
              options={[
                { value: "", label: "Seleccione un tipo" },
                { value: "obligatoria", label: "Obligatoria" },
                { value: "electiva", label: "Electiva" },
              ]}
              onChange={handleChange}
              style={{
                container: { textAlign: "left" },
                select: { width: "100%" },
              }}
            />
            <div className="text-danger position-absolute" style={{ fontSize: "0.75rem", top: "100%", left: "5px", height: "12px" }}>
              {errors.tipo}
            </div>
          </div>

          {/* Número de período académico */}
          <div className="position-relative">
            <InputField
              label={
                <span>
                  Número de Período Académico: <span className="text-danger">*</span>
                </span>
              }
              id="numeroPeriodoAcademico"
              type="number"
              placeholder="Ingrese el número de período académico"
              value={formData.numeroPeriodoAcademico}
              onChange={handleChange}
              style={{
                container: { textAlign: "left" },
                input: { width: "100%" },
              }}
            />
            <div className="text-danger position-absolute" style={{ fontSize: "0.75rem", top: "100%", left: "5px", height: "12px" }}>
              {errors.numeroPeriodoAcademico}
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

export default RegistrarMateriaForm;

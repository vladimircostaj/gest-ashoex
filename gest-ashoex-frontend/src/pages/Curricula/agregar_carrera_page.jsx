import React, { useState } from "react";
import Title from "../../components/typography/title";
import InputField from "../../components/form/inputField";
import SaveButton from "../../components/buttons/saveButton";
import CancelButton from "../../components/buttons/cancelButton";
import Breadcrumbs from "../../components/BreadCrumb/breadcrumb";

const AgregarCarreraPage = () => {
  const [formData, setFormData] = useState({
    id: "",
    nombre: "",
    numeroSemestres: "",
  });

  const [errors, setErrors] = useState({});

  const breadcrumbRoutes = [
    { label: "Home", path: "/" },
    { label: "Currícula", path: "/curricula" },
    { label: "Registrar Carrera", path: "/registrar-carrera" },
  ];

  const handleChange = (e) => {
    const { id, value } = e.target;
    setFormData({ ...formData, [id]: value });

    // Elimina el error si el campo no está vacío
    if (value.trim() !== "") {
      setErrors({ ...errors, [id]: "" });
    }
  };

  const handleSave = async () => {  //async
    const newErrors = {};

    // Validación de campos obligatorios
    Object.keys(formData).forEach((key) => {
      if (!formData[key].trim()) {
        newErrors[key] = "Campo obligatorio";
      }
    });

    setErrors(newErrors);

    if (Object.keys(newErrors).length === 0) {
      // Aquí puedes agregar la lógica para guardar la nueva carrera
      setLoading(true);
      try {
        const response = await fetch("http://127.0.0.1:8000/api/curriculas", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify({
            carrera_id: formData.id,
            carrera_nombre: formData.nombre,
            carrera_numeroSemestres: formData.numeroSemestres,
          }),
        });

        const result = await response.json();

        if (response.ok) {
          alert("Carrera guardada");
          setFormData({
            id: "",
    	      nombre: "",
    	      numeroSemestres: "",
          });
        } else {
          alert(result.error?.message || "Error al guardar carrera");
        }
      } catch (error) {
        console.error("Error al guardar:", error);
        alert("Error en la conexión.");
      } finally {
        setLoading(false);
      }
      // console.log("Guardado:", formData);
    }
  };

  const handleCancel = () => {
    console.log("Registro cancelado");
  };

  return (
    <div className="d-flex flex-column gap-4 p-3">
      {/* Breadcrumbs */}
      <Breadcrumbs routes={breadcrumbRoutes} />

      <div className="d-flex justify-content-center align-items-center vh-100 bg-light">
        <div
          className="card shadow-lg rounded-4 p-4"
          style={{ maxWidth: "400px", width: "100%" }}
        >
          <div className="mb-3">
            <Title text="Agregar Carrera" />
          </div>

          <form
            className="d-flex flex-column gap-4"
            onSubmit={(e) => e.preventDefault()}
          >
            {/* ID / Código */}
            <div className="position-relative">
              <InputField
                label={
                  <span>
                    ID/Código: <span className="text-danger">*</span>
                  </span>
                }
                id="id"
                placeholder="Ingrese el ID o código de la carrera"
                value={formData.id}
                onChange={handleChange}
                style={{
                  container: { textAlign: "left" },
                  input: { width: "100%" },
                }}
              />
              <div
                className="text-danger position-absolute"
                style={{
                  fontSize: "0.75rem",
                  top: "100%",
                  left: "5px",
                  height: "12px",
                }}
              >
                {errors.id}
              </div>
            </div>

            {/* Nombre */}
            <div className="position-relative">
              <InputField
                label={
                  <span>
                    Nombre: <span className="text-danger">*</span>
                  </span>
                }
                id="nombre"
                placeholder="Ingrese el nombre de la carrera"
                value={formData.nombre}
                onChange={handleChange}
                style={{
                  container: { textAlign: "left" },
                  input: { width: "100%" },
                }}
              />
              <div
                className="text-danger position-absolute"
                style={{
                  fontSize: "0.75rem",
                  top: "100%",
                  left: "5px",
                  height: "12px",
                }}
              >
                {errors.nombre}
              </div>
            </div>

            {/* Número de Semestres */}
            <div className="position-relative">
              <InputField
                label={
                  <span>
                    Número de Semestres: <span className="text-danger">*</span>
                  </span>
                }
                id="numeroSemestres"
                type="number"
                placeholder="Ingrese el número de semestres"
                value={formData.numeroSemestres}
                onChange={handleChange}
                style={{
                  container: { textAlign: "left" },
                  input: { width: "100%" },
                }}
              />
              <div
                className="text-danger position-absolute"
                style={{
                  fontSize: "0.75rem",
                  top: "100%",
                  left: "5px",
                  height: "12px",
                }}
              >
                {errors.numeroSemestres}
              </div>
            </div>

            {/* Botones de Acción */}
            <div className="d-flex justify-content-between gap-2 mt-3">
              <CancelButton onClick={handleCancel} />
              <SaveButton onClick={handleSave} />
            </div>
          </form>
        </div>
      </div>
    </div>
  );
};

export default AgregarCarreraPage;

import React, { useState, useEffect } from "react";
import Title from "../../components/typography/title";
import InputField from "../../components/form/inputField";
import SaveButton from "../../components/buttons/saveButton";
import CancelButton from "../../components/buttons/cancelButton";
import Breadcrumbs from "../../components/BreadCrumb/breadcrumb";
import { useParams, useHistory } from "react-router-dom";

const EditarCarreraPage = () => {
  const { id } = useParams(); // Obtener el ID de la carrera a editar desde la URL
  const history = useHistory();

  // Estado inicial, en un caso real lo cargarías desde una API o una base de datos
  const [formData, setFormData] = useState({
    id: "",
    nombre: "",
    numeroSemestres: "",
  });

  const [errors, setErrors] = useState({});



  useEffect(() => {
    const cargarCarrera = () => {
      const carrera = {
        id: id,
        nombre: "Ingeniería en Computación",
        numeroSemestres: 10,
      };
      setFormData(carrera);
    };
    cargarCarrera();
  }, [id]);

  const handleChange = (e) => {
    const { id, value } = e.target;
    setFormData({ ...formData, [id]: value });

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
      console.log("Carrera editada:", formData);
      // Simula la navegación después de guardar
      history.push("/curricula");
    }
  };

  const handleCancel = () => {
    console.log("Edición cancelada");
    // Redirige a la página de listado de carreras
    history.push("/curricula");
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
            <Title text="Editar Carrera" />
          </div>

          <form
            className="d-flex flex-column gap-4"
            onSubmit={(e) => e.preventDefault()}
          >
            {/* ID / Código (solo lectura) */}
            <div className="position-relative">
              <InputField
                label={
                  <span>
                    ID/Código: <span className="text-danger">*</span>
                  </span>
                }
                id="id"
                placeholder="ID de la carrera"
                value={formData.id}
                onChange={handleChange}
                disabled
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

export default EditarCarreraPage;

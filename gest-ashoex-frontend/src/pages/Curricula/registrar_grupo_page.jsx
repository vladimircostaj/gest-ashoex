import React, { useState } from "react";
import Title from "../../components/typography/title";
import InputField from "../../components/form/inputField";
import SaveButton from "../../components/buttons/saveButton";
import CancelButton from "../../components/buttons/cancelButton";
import Breadcrumbs from "../../components/BreadCrumb/breadcrumb";
import { useParams } from 'react-router-dom';

const RegistrarGrupoPage = () => {
  const [formData, setFormData] = useState({
    nro_grupo: "",
  });

  const { materiaId } = useParams();

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

  const handleSave = async () => {
    const newErrors = {};

    // Validación de campos obligatorios
    Object.keys(formData).forEach((key) => {
      if (!formData[key].trim()) {
        newErrors[key] = "Campo obligatorio";
      }
    });

    setErrors(newErrors);

    if (Object.keys(newErrors).length === 0) {

      const data = {
        nro_grupo: formData.nro_grupo,
        materia_id: materiaId,
       };

        try {
            const response = await fetch("http://127.0.0.1:8000/api/grupos", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify(data), 
            });

            if (!response.ok) {
                const errorData = await response.json();
                console.error("Error al crear el grupo:", errorData.message);
                return;
            }
        
            const result = await response.json();
            console.log("Grupo creado:", result);
            window.location.href = "/listar-materias";
        } catch (error) {
            console.error("Error al crear el grupo:", error.response?.data || error.message);
        }

    }


  };

  const handleCancel = () => {
    console.log("Registro cancelado");
  };

  return (
    <div className="d-flex flex-column gap-4 p-3">
      {/* Breadcrumbs */}

      <div className="d-flex justify-content-center align-items-center vh-100 bg-light">
        <div
          className="card shadow-lg rounded-4 p-4"
          style={{ maxWidth: "400px", width: "100%" }}
        >
          <div className="mb-3">
            <Title text="Agregar Grupo" />
          </div>

          <form
            className="d-flex flex-column gap-4"
            onSubmit={(e) => e.preventDefault()}
          >

            {/* Numero de grupo */}
            <div className="position-relative">
              <InputField
                label={
                  <span>
                    Numero de grupo: <span className="text-danger">*</span>
                  </span>
                }
                id="nro_grupo"
                placeholder="Ingrese el numero de grupo"
                value={formData.nro_grupo}
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
                {errors.nro_grupo}
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

export default RegistrarGrupoPage;

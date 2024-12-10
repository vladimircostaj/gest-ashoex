import { useState, useEffect } from "react";
import Title from "../../components/typography/title";
import InputField from "../../components/form/inputField";
import SaveButton from "../../components/buttons/saveButton";
import CancelButton from "../../components/buttons/cancelButton";
// import Breadcrumbs from "../../components/BreadCrumb/breadcrumb";
import { useParams, useNavigate } from "react-router-dom";

import carrerasService from "../../services/carrerasService.js";

const EditarCarreraPage = () => {
   const { id } = useParams(); // Obtener el ID de la carrera a editar desde la URL
   const navigate = useNavigate(); // Sustituye useHistory por useNavigate

   // Estado inicial, en un caso real lo cargarías desde una API o una base de datos
   const [formData, setFormData] = useState({
      id: "",
      nombre: "",
      numeroSemestres: "",
   });

   const [errors, setErrors] = useState({});

   useEffect(() => {
      const cargarCarrera = async () => {
         try {
            const carrera = await carrerasService.fetchCarreraById(id); // Llamada al servicio
            setFormData({
               id: carrera.id,
               nombre: carrera.nombre,
               numeroSemestres: carrera.nro_semestres, // Asegúrate de que los nombres coincidan
            });
         } catch (error) {
            console.error("Error al cargar la carrera:", error.message);
            setErrors({ global: error.message });
         }
      };

      cargarCarrera();
   }, [id]);

   const handleChange = (e) => {
      const { id, value } = e.target;
      setFormData({
         ...formData,
         [id]: id === "numeroSemestres" ? Number(value) : value, // Convierte a número si es necesario
      });

      if (value.trim() !== "") {
         setErrors({ ...errors, [id]: "" });
      }
   };

   const handleSave = async () => {
      const newErrors = {};

      // Validación de campos obligatorios
      Object.keys(formData).forEach((key) => {
         const value = formData[key];
         if (typeof value === "string" && !value.trim()) {
            newErrors[key] = "Campo obligatorio";
         }
         if (key === "numeroSemestres" && (isNaN(value) || value <= 0)) {
            newErrors[key] = "Debe ser un número válido";
         }
      });

      setErrors(newErrors);

      if (Object.keys(newErrors).length === 0) {
         try {
            const updatedData = {
               nombre: formData.nombre,
               nro_semestres: formData.numeroSemestres, // Mapear al formato esperado por el backend
            };

            // Llamar al servicio de actualización
            await carrerasService.updateCarrera(id, updatedData);

            console.log("Carrera actualizada exitosamente:", updatedData);

            // Redirigir después de guardar
            navigate("/mostrar-carreras");
         } catch (error) {
            console.error("Error al guardar la carrera:", error.message);
            setErrors({ global: error.message }); // Manejo de errores global
         }
      }
   };

   const handleCancel = () => {
      console.log("Edición cancelada");
      // Redirige a la página de listado de carreras
      navigate("/mostrar-carreras"); // Usa navigate en lugar de history.push
   };

   return (
      <div className="d-flex flex-column p-3 mt-4">
         {/* Breadcrumbs */}
         {/* <Breadcrumbs routes={breadcrumbRoutes} /> */}

         <div className="d-flex justify-content-center align-items-center vh-100 bg-light">
            <div className="card shadow-lg rounded-4 p-4" style={{ maxWidth: "400px", width: "100%" }}>
               <div className="mb-3">
                  <Title text="Editar Carrera" />
               </div>

               <form className="d-flex flex-column gap-4" onSubmit={(e) => e.preventDefault()}>
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
                        disabled={true}
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

import React, { useEffect, useState } from "react";
import Title from "../../components/typography/title";
import InputField from "../../components/form/inputField";
import SelectField from "../../components/form/selectField";
import SaveButton from "../../components/buttons/saveButton";
import CancelButton from "../../components/buttons/cancelButton";
import { createMateria } from "../../services/materiaService";
import { Snackbar } from "@mui/material";
import Breadcrumbs from "../../components/BreadCrumb/breadcrumb"

import "./registrar_materia.css";

const RegistrarMateriaForm = () => {
    const [snackbar, setSnackbar] = useState({
        open: false,
        message: "",
        severity: "success",
    });
    const breadcrumbRoutes = [
        { label: "Home", path: "/" },
        { label: "Currícula", path: "/curricula" },
        { label: "Registrar Materia", path: "/registrar-materia" },
    ];
    const [formData, setFormData] = useState({
        codigo: "",
        nombre: "",
        tipo: "",
        nro_PeriodoAcademico: "",
    });

    const [errors, setErrors] = useState({});
    useEffect(() => {
        console.log(errors);
    }, [errors]);

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
            console.log("Guardado:", formData);
            try {
                const response = await createMateria(formData);

                if (response.success) {
                    console.log("exito", response);
                    setSnackbar({
                        open: true,
                        message: "Materia registrada exitosamente",
                        severity: "success",
                    });
                    setFormData({
                        codigo: "",
                        nombre: "",
                        tipo: "",
                        nro_PeriodoAcademico: "",
                    });
                } else {
                    console.log("error", response);
                    const newErrors = {};
                    response.error.forEach((error) => {
                        newErrors[error.field] = error.detail;
                    });
                    setErrors(newErrors);
                }
            } catch (error) {
                console.log("catch error", error);
                setSnackbar({
                    open: true,
                    message: "Error al registrar la materia",
                    severity: "error",
                });
            }
        }
    };

    const handleCancel = () => {
        setFormData({
            codigo: "",
            nombre: "",
            tipo: "",
            nro_PeriodoAcademico: "",
        });
        setErrors({});
        console.log("Registro cancelado");
    };

    return (
    <div className="container mt-4">
        <div className="d-flex flex-column justify-content-center align-items-center gap-3">
            <div className="mb-3">
                <Breadcrumbs routes={breadcrumbRoutes} />
            </div>
            <div
                className="card shadow-lg rounded-4 p-4 vw-100"
                style={{ maxWidth: "400px", width: "100%" }}
            >
                <div className="mb-3">
                    <Title text="Registrar Materia" />
                </div>

                <form
                    className="d-flex flex-column gap-4"
                    onSubmit={(e) => e.preventDefault()}
                >
                    {/* Código de materia */}
                    <div className="position-relative">
                        <InputField
                            label={
                                <span>
                                    Código:{" "}
                                    <span className="text-danger">*</span>
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
                        <div
                            className="text-danger position-absolute"
                            style={{
                                fontSize: "0.75rem",
                                top: "100%",
                                left: "5px",
                                height: "12px",
                            }}
                        >
                            {errors.codigo}
                        </div>
                    </div>

                    {/* Nombre de la materia */}
                    <div className="position-relative">
                        <InputField
                            label={
                                <span>
                                    Nombre:{" "}
                                    <span className="text-danger">*</span>
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
                        <div
                            className="text-danger position-absolute"
                            style={{
                                fontSize: "0.75rem",
                                top: "100%",
                                left: "5px",
                                height: "12px",
                            }}
                        >
                            {errors.tipo}
                        </div>
                    </div>

                    {/* Número de período académico */}
                    <div className="position-relative">
                        <InputField
                            label={
                                <span>
                                    Número de Período Académico:{" "}
                                    <span className="text-danger">*</span>
                                </span>
                            }
                            id="nro_PeriodoAcademico"
                            type="number"
                            placeholder="Ingrese el número de período académico"
                            value={formData.nro_PeriodoAcademico}
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
                            {errors.nro_PeriodoAcademico}
                        </div>
                    </div>

                    {/* Botones de acción */}
                    <div className="d-flex justify-content-between gap-2 mt-3">
                        <CancelButton onClick={handleCancel} />
                        <SaveButton onClick={handleSave} />
                    </div>
                </form>
            </div>
            <Snackbar
                open={snackbar.open}
                autoHideDuration={6000}
                onClose={() => setSnackbar({ ...snackbar, open: false })}
                message={snackbar.message}
                severity={snackbar.severity}
            />
        </div>
    </div>
    );
};

export default RegistrarMateriaForm;

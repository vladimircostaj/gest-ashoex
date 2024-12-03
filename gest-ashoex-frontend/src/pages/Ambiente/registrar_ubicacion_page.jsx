import React, { useState, useEffect } from "react";
import axios from 'axios';

import Title from "../../components/typography/title";
import InputField from "../../components/form/inputField";
import SelectField from "../../components/form/selectField";
import SaveButton from "../../components/buttons/saveButton";
import CancelButton from "../../components/buttons/cancelButton";
import "./registrar_ubicacion.css";

const RegistrarUbicacionForm = () => {
    const [edificios, setEdificios] = useState([]);
    const [edificioSelected, setEdificioSelected] = useState("");
    const [numeroPiso, setNumeroPiso] = useState("");
    const [errors, setErrors] = useState({});
    const api = "http://127.0.0.1:8000/api";

    const fetchEdificios = async () => {
        try {
            const response = await axios.get(`${api}/edificios`);
            if (Array.isArray(response.data.data)) {
                setEdificios(response.data.data);
            } else {
                console.error('La respuesta de la API no es un array:', response.data.data);
                setEdificios([]);
            }
        } catch (error) {
            console.error('Error fetching edificios:', error);
            setEdificios([]);
        }
    };

    useEffect(() => {
        fetchEdificios();
    }, []);

    const handleChange = (e) => {
        const { id, value } = e.target;
        if (id === "numero_piso") {
            setNumeroPiso(value);
        } else if (id === "id_ubicacion") {
            setEdificioSelected(value);
        }
    };

    const validate = () => {
        const newErrors = {};
        if (!numeroPiso) {
            newErrors.numeroPiso = "El número de piso es requerido";
        } else if (numeroPiso > 20) {
            newErrors.numeroPiso = "El número de piso no puede ser mayor a 20";
        }
        if (!edificioSelected) {
            newErrors.edificioSelected = "El edificio es requerido";
        }
        setErrors(newErrors);
        return Object.keys(newErrors).length === 0;
    };

    const handleCancel = () => {
        console.log("Registro cancelado");
    };

    const handleSave = (e) => {
        e.preventDefault();
        if (validate()) {
            console.log("Datos guardados:", { numeroPiso, edificioSelected });
        } else {
            console.log("Errores en el formulario:", errors);
        }
    };

    return (
        <div className="form-container">
            <div className="card form-card">
                <div className="mb-3 text-center">
                    <Title text="Registrar Ubicación" />
                </div>

                <form className="d-flex flex-column gap-3">
                    <InputField
                        label="Número de piso:"
                        id="numero_piso"
                        type="number"
                        placeholder="Ingrese el número del aula"
                        value={numeroPiso}
                        onChange={handleChange}
                        style={{
                            container: { textAlign: "left" },
                            input: { width: "100%" },
                        }}
                    />
                    
                    {errors.numeroPiso && <div className="error">{errors.numeroPiso}</div>}
                    
                    <SelectField
                        label="Edificio:"
                        id="id_ubicacion"
                        options={[
                            { value: "", label: "Seleccione un edificio" },
                            ...edificios.filter(edificio => edificio !== null && edificio !== undefined).map((edificio) => ({
                                value: edificio.id_edificio,
                                label: edificio.nombre_edificio,
                            })),
                        ]}
                        value={edificioSelected}
                        onChange={handleChange}
                        style={{
                            container: { textAlign: "left" },
                            select: { width: "100%" },
                        }}
                    />

                    {errors.edificioSelected && <div className="error">{errors.edificioSelected}</div>}     

                    <div className="d-flex justify-content-between gap-2 mt-3">
                        <CancelButton onClick={handleCancel} />
                        <SaveButton onClick={handleSave} />
                    </div>
                </form>
            </div>
        </div>
    );
};

export default RegistrarUbicacionForm;
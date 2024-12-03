import React, { useState, useEffect } from "react";
import Title from "../../components/typography/title";
import InputField from "../../components/form/inputField";
import SelectField from "../../components/form/selectField";
import SaveButton from "../../components/buttons/saveButton";
import CancelButton from "../../components/buttons/cancelButton";
//import { useParams, useHistory } from "react-router-dom";
import { useParams } from "react-router-dom";
import "./registrar_ambiente.css";

const EditarEdificioPage = () => {
  const { id } = useParams(); // Obtener el ID de la edificio a editar desde la URL
  //const history = useHistory();

  // Estado inicial, en un caso real lo cargarías desde una API o una base de datos
  const edificios = [
    {
      id: 1,
      nombre: "Edificio Nuevo",
      geolocalizacion: "19.4326° N, 99.1332° W",
    },
    {
      id: 2,
      nombre: "Edificio Multiacademico",
      geolocalizacion: "34.0522° N, 118.2437° W",
    },
    {
      id: 3,
      nombre: "Edificio Memi",
      geolocalizacion: "48.8566° N, 2.3522° E",
    },
  ];
  const [edificioValue, setEdificioValue] = useState({});

  const [errors, setErrors] = useState({});

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
      console.log("Edificio editado:", formData);
      // Simula la navegación después de guardar
      //history.push("/curricula");
    }
  };

  const handleCancel = () => {
    console.log("Edición cancelada");
    // Redirige a la página de listado de carreras
    //history.push("/curricula");
  };

  const selectEdificio = (event) => {
    const index = event.target.selectedIndex;
    const optionElement = event.target.childNodes[index];
    const optionElementId = optionElement.getAttribute("id");
    setEdificioValue(edificios.find(({ id }) => id == optionElement.value));
  };

  return (
    <div className="form-container">
      <div className="card form-card">
        <div className="mb-3 text-center">
          <Title text="Editar Edificio" />
        </div>

        <form className="d-flex flex-column gap-3">
          {/* ID / Código (solo lectura) */}

          <SelectField
            label={
              <span>
                ID/Código: <span className="text-danger">*</span>
              </span>
            }
            id="id"
            placeholder="ID de la edificio"
            onChange={selectEdificio}
            options={[
              { value: "", label: "eliga un edificio " },
              ...edificios.map((edificio) => ({
                value: edificio.id,
                label: edificio.id + " " + edificio.nombre,
              })),
            ]}
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

          {/* Nombre del edificio*/}

          <InputField
            label={
              <span>
                Nombre del Edificio: <span className="text-danger">*</span>
              </span>
            }
            id="nombre"
            placeholder="Ingrese el nombre de la edificio"
            value={edificioValue.nombre}
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

          {/* Número de Semestres */}

          <InputField
            label={
              <span>
                Geolocalizacion: <span className="text-danger">*</span>
              </span>
            }
            id="geolocalizacion"
            placeholder="Ingrese la geolocalizacion del edificio"
            value={edificioValue.geolocalizacion}
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
            {errors.geolocalizacion}
          </div>

          {/* Botones de Acción */}
          <div className="d-flex justify-content-between gap-2 mt-3">
            <CancelButton onClick={handleCancel} />
            <SaveButton onClick={handleSave} />
          </div>
        </form>
      </div>
    </div>
  );
};

export default EditarEdificioPage;

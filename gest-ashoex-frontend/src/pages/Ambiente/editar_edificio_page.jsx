import React, { useState, useEffect } from "react";
import Title from "../../components/typography/title";
import InputField from "../../components/form/inputField";
import SelectField from "../../components/form/selectField";
import SaveButton from "../../components/buttons/saveButton";
import CancelButton from "../../components/buttons/cancelButton";
import { useParams ,useNavigate} from "react-router-dom";
import "./registrar_ambiente.css";
import axios from "axios";

const EditarEdificioPage = () => {
  const { edificioId } = useParams(); // Obtener el ID de la edificio a editar desde la URL
  const endpoint = `http://localhost:8000/api/edificios`;
  const navigate = useNavigate();
  // Estado inicial, en un caso real lo cargarías desde una API o una base de datos
  const edificios = [
    {
      id: 1,
      nombre_edificio: "Edificio Nuevo",
      geolocalizacion: "19.4326° N, 99.1332° W",
    },
    {
      id: 2,
      nombre_edificio: "Edificio Multiacademico",
      geolocalizacion: "34.0522° N, 118.2437° W",
    },
    {
      id: 3,
      nombre_edificio: "Edificio Memi",
      geolocalizacion: "48.8566° N, 2.3522° E",
    },
  ];
  const [edificioValue, setEdificioValue] = useState({
    id:"",
    nombre_edificio: "",
    geolocalizacion: "",
  });
 
  const [errors, setErrors] = useState({});

  const handleChange = (e) => {
    const { id, value } = e.target;
    setEdificioValue({ ...edificioValue, [id]: value });
  };

  const handleSave = async (e) => {
    e.preventDefault();

    try {
      const response = await axios.put(endpoint + "/" + edificioId, edificioValue);
      console.log(response);
      if (response.data.success) {
        console.log("Datos guardados correctamente", response.data);
        setErrors({});
        navigate("/lista-edificios");
      }
    } catch (error) {
      console.error("Error al guardar los datos:", error);
      if (error.response && error.response.data) {
        const errorMessages = error.response.data.error.reduce((acc, curr) => {
          if (curr.detail.includes("nombre del edificio")||curr.detail.includes("nombre de edificio")) {
            acc.nombre_edificio = curr.detail;
          } 
          if (curr.detail.includes("geolocalización")||curr.detail.includes("geolocalizacion")) {
            acc.geolocalizacion = curr.detail;
          }
          return acc;
        }, {});
        setErrors(errorMessages);
      }
    }
  };

  const handleCancel = () => {
    navigate("/lista-edificios");
  };

  useEffect(() => {
    setEdificioValue(edificios.find(({ id }) => id == edificioId));
  }, []);

  return (
    <div className="form-container">
      <div className="card form-card">
        <div className="mb-3 text-center">
          <Title text="Editar Edificio" />
        </div>

        <form className="d-flex flex-column gap-3">
          {/* ID / Código (solo lectura) */}

          <InputField
            label={<span>ID/Código:</span>}
            id="id"
            placeholder="ID de la edificio"
            value={edificioValue.id}
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

          <div>
            <InputField
              label={
                <span>
                  Nombre del Edificio: <span className="text-danger">*</span>
                </span>
              }
              id="nombre_edificio"
              placeholder="Ingrese el nombre de la edificio"
              value={edificioValue.nombre_edificio}
              onChange={handleChange}
              error={errors.nombre_edificio}
              style={{
                container: { textAlign: "left" },
                input: { width: "100%" },
              }}
            />
            <div className="text-danger">{errors.nombre_edificio}</div>
          </div>

          {/* Número de Semestres */}
          <div>
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
            <div className="text-danger">{errors.geolocalizacion}</div>
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

import { useState, useEffect } from "react";
import Title from "../../components/typography/title";
import InputField from "../../components/form/inputField";
import SelectField from "../../components/form/selectField";
import SaveButton from "../../components/buttons/saveButton";
import CancelButton from "../../components/buttons/cancelButton";
import { useParams } from "react-router-dom";
import "./registrar_personalAcademico.css"; 

const EditarPersonalAcademico = () => {
  const { personalId } = useParams(); 

  const [formData, setFormData] = useState({
    nombre: "",
    apellido: "",
    correo: "",
    id_departamento: "",
    id_rol: "",
  });

  const [disponibles, setDisponibles] = useState({
    departamentos: [],
    roles: [],
  });

  // Simulando una lista de personal académico
  const personalAcademico = [
    {
      id: "1",
      nombre: "Juan",
      apellido: "Pérez",
      correo: "juan.perez@universidad.com",
      id_departamento: "1",
      id_rol: "1",
    },
    {
      id: "2",
      nombre: "Ana",
      apellido: "González",
      correo: "ana.gonzalez@universidad.com",
      id_departamento: "2",
      id_rol: "2",
    },
    {
      id: "3",
      nombre: "Carlos",
      apellido: "López",
      correo: "carlos.lopez@universidad.com",
      id_departamento: "1",
      id_rol: "3",
    },
  ];

  // Simulando la carga de opciones disponibles
  const dataDisponibles = {
    departamentos: [
      { id: "1", nombre: "Ciencias Sociales" },
      { id: "2", nombre: "Ingeniería" },
    ],
    roles: [
      { id: "1", nombre: "Profesor" },
      { id: "2", nombre: "Investigador" },
      { id: "3", nombre: "Asistente" },
    ],
  };

};

export default EditarPersonalAcademico;

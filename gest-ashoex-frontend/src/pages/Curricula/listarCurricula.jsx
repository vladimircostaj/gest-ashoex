import { useEffect, useState } from "react";
import { FaEdit, FaTrash } from "react-icons/fa";
import "./listar_curricula.css";
import Title from "../../components/typography/title";
import { Link } from "react-router-dom";
import {
    getAllCurriculas,
    deleteCurricula,
} from "../../services/curriculaService";
import { CircularProgress, Container } from "@mui/material";

const ListarCurriculas = () => {
    const [curriculas, setCurriculas] = useState([]);
    const [isCurriculasLoading, setIsCurriculasLoading] = useState(true);
    const [error, setError] = useState(null);

    useEffect(() => {
        getAllCurriculas()
            .then((response) => {
                console.log(response);
                setCurriculas(response.data);
                setIsCurriculasLoading(false);
            })
            .catch((error) => {
                setError(error);
                setIsCurriculasLoading(false);
            });
    }, []);

    if (isCurriculasLoading) {
        return (
            <Container
                style={{
                    display: "flex",
                    justifyContent: "center",
                    alignItems: "center",
                    height: "80vh",
                }}
            >
                <CircularProgress />
            </Container>
        );
    }

    if (error) {
        return <div>Error: {error.message}</div>;
    }

    return (
        <div className="container mt-5">
            <div className="table title">
                <div className="row">
                    <div className="">
                        <Title text={"Listado de Currículas"}></Title>
                    </div>
                </div>
            </div>
            <table className="table table-striped table-hover">
                <thead>
                    <tr>
                        <th># ID</th>
                        <th>Carrera</th>
                        <th>Materia</th>
                        <th>Nivel</th>
                        <th>Electiva</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    {curriculas.length === 0 ? (
                        <tr>
                            <td colSpan="6" className="text-center">
                                No hay currículas registradas
                            </td>
                        </tr>
                    ) : (
                        curriculas.map((curricula) => (
                            <tr key={curricula.id}>
                                <td>{curricula.id}</td>
                                <td>{curricula.carrera.nombre}</td>
                                <td>{curricula.materia.nombre}</td>
                                <td>{curricula.nivel}</td>
                                <td>{curricula.electiva ? "Si" : "No"}</td>
                                <td>
                                    <Link
                                        to={`/editar-curricula/${curricula.id}`}
                                        className="edit mr-6 ml-6"
                                    >
                                        <FaEdit />
                                    </Link>
                                    <a href="#" className="delete mr-6 ml-6">
                                        <FaTrash />
                                    </a>
                                </td>
                            </tr>
                        ))
                    )}
                </tbody>
            </table>
        </div>
    );
};

export default ListarCurriculas;

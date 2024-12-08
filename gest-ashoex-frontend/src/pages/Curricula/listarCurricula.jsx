import { useEffect, useState } from "react";
import { FaEdit, FaTrash } from "react-icons/fa";
import "./listar_curricula.css";
import Title from "../../components/typography/title";
import { Link } from "react-router-dom";
import {
    getAllCurriculas,
    deleteCurricula,
} from "../../services/curriculaService";
import {
    CircularProgress,
    Container,
    Dialog,
    DialogTitle,
    DialogContent,
    DialogActions,
    Button,
    Typography,
    Snackbar,
} from "@mui/material";

const ListarCurriculas = () => {
    const [curriculas, setCurriculas] = useState([]);
    const [isCurriculasLoading, setIsCurriculasLoading] = useState(true);
    const [isCurriculaDeleting, setIsCurriculaDeleting] = useState(false);
    const [error, setError] = useState(null);
    const [curriculaToDelete, setCurriculaToDelete] = useState(null);
    const [isDialogOpen, setIsDialogOpen] = useState(false);
    const [snackbar, setSnackbar] = useState({
        open: false,
        message: "",
        severity: "success",
    });

    const handleOpenDialog = (curricula) => {
        setCurriculaToDelete(curricula);
        setIsDialogOpen(true);
    };

    const handleCloseDialog = () => {
        setCurriculaToDelete(null);
        setIsDialogOpen(false);
    };

    const handleDeleteCurricula = () => {
        if (curriculaToDelete) {
            setIsCurriculaDeleting(true);
            deleteCurricula(curriculaToDelete.id)
                .then(() => {
                    setCurriculas(
                        curriculas.filter((c) => c.id !== curriculaToDelete.id)
                    );
                    handleCloseDialog();
                    setCurriculaToDelete(null);
                    setIsCurriculaDeleting(false);
                    setSnackbar({
                        open: true,
                        message: "Currícula eliminada correctamente",
                        severity: "success",
                    });
                })
                .catch((error) => {
                    handleCloseDialog();
                    setIsCurriculaDeleting(false);
                    setSnackbar({
                        open: true,
                        message: "Error al eliminar la currícula",
                        severity: "error",
                    });
                    console.error("Error al eliminar la currícula:", error);
                });
        }
    };

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

    if (isCurriculasLoading || isCurriculaDeleting) {
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
                                    <a
                                        href="#"
                                        className="delete mr-6 ml-6"
                                        onClick={() =>
                                            handleOpenDialog(curricula)
                                        }
                                    >
                                        <FaTrash />
                                    </a>
                                </td>
                            </tr>
                        ))
                    )}
                </tbody>
            </table>
            {/* Dialog de confirmación */}
            <Dialog
                open={isDialogOpen}
                onClose={handleCloseDialog}
                aria-labelledby="dialog-title"
                aria-describedby="dialog-description"
            >
                <DialogTitle id="dialog-title">
                    Confirmación de Eliminación
                </DialogTitle>
                <DialogContent>
                    <Typography id="dialog-description">
                        ¿Estás seguro de que deseas eliminar la currícula con ID{" "}
                        {curriculaToDelete?.id}?
                    </Typography>
                </DialogContent>
                <DialogActions>
                    <Button
                        variant="contained"
                        color="error"
                        onClick={handleDeleteCurricula}
                    >
                        Eliminar
                    </Button>
                    <Button variant="outlined" onClick={handleCloseDialog}>
                        Cancelar
                    </Button>
                </DialogActions>
            </Dialog>
            {/* Snackbar */}
            <Snackbar
                open={snackbar.open}
                autoHideDuration={6000}
                onClose={() => setSnackbar({ ...snackbar, open: false })}
                message={snackbar.message}
                severity={snackbar.severity}
            />
        </div>
    );
};

export default ListarCurriculas;

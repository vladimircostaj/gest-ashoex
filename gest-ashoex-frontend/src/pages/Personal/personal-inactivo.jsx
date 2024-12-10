import React, { useState, useEffect } from "react";
import styled from "styled-components";
import {
  List,
  ListItem,
  ListItemText,
  IconButton,
  Divider,
  Modal,
  Box,
  Typography,
  Button,
} from "@mui/material";
import RestoreIcon from "@mui/icons-material/Restore";
import DeleteIcon from "@mui/icons-material/Delete";
import PersonOffIcon from "@mui/icons-material/PersonOff";
import {reactivarPersonal, eliminarPersonal } from "../../services/personalService"; 
import {getListaPersonal} from "../../services/ListaPersonalService"
import { toast } from "sonner";

const PersonalInactivo = () => {
  const [inactiveUsers, setInactiveUsers] = useState([]);
  const [openModal, setOpenModal] = useState(false);
  const [selectedUser, setSelectedUser] = useState(null);
  const [actionType, setActionType] = useState("");

  // Cargar los datos del personal
  useEffect(() => {
    const loadPersonal = async () => {
      try {
        const response = await getListaPersonal();
        const inactiveUsers = response.data.filter(
          (user) => user.estado === "DESPEDIDO"
        );
        setInactiveUsers(inactiveUsers);
      } catch (error) {
        console.error("Error al cargar el personal:", error);
      }
    };

    loadPersonal(); 
  }, []); 

  const handleOpenModal = (user, action) => {
    setSelectedUser(user);
    setActionType(action);
    setOpenModal(true);
  };

  const handleCloseModal = () => {
    setOpenModal(false);
    setSelectedUser(null);
    setActionType("");
  };

  const handleConfirmAction = async () => {
    if (actionType === "reactivar") {
      try {
        // Realizar la acción de reactivar
        await reactivarPersonal(selectedUser.personal_academico_id);
        setInactiveUsers(inactiveUsers.filter(user => user.personal_academico_id !== selectedUser.personal_academico_id));
        toast.success("Personal activo");
      } catch (error) {
        console.error("Error reactivando el usuario:", error);
      }
    } else if (actionType === "eliminar") {
      try {
        // Realizar la acción de eliminar
        await eliminarPersonal(selectedUser.personal_academico_id);
        setInactiveUsers(inactiveUsers.filter(user => user.personal_academico_id !== selectedUser.personal_academico_id));
        toast.success("Se elimino personal");
      } catch (error) {
        console.error("Error eliminando el usuario:", error);
      }
    }
    handleCloseModal();
  };

  const renderModal = () => (
    <Modal open={openModal} onClose={handleCloseModal}>
      <Box sx={modalStyle}>
        <Typography variant="h6" component="h2">
          {actionType === "reactivar"
            ? `¿Reactivar a ${selectedUser?.nombre}?`
            : `¿Eliminar a ${selectedUser?.nombre}?`}
        </Typography>
        <Typography sx={{ mt: 2 }}>
          {actionType === "reactivar"
            ? "El usuario será reactivado y regresará a la lista de personal activo."
            : "El usuario será eliminado permanentemente."}
        </Typography>
        <Box
          sx={{ display: "flex", justifyContent: "center", gap: "10px", mt: 3 }}
        >
          <Button
            variant="contained"
            color="primary"
            onClick={handleConfirmAction}
          >
            Confirmar
          </Button>
          <Button
            variant="outlined"
            color="secondary"
            onClick={handleCloseModal}
          >
            Cancelar
          </Button>
        </Box>
      </Box>
    </Modal>
  );

  return (
    <SectionWrapper className="mt-5">
      <h2 style={{ textAlign: "center" }}>Personal Inactivo</h2>
      <Divider />
      <List>
        {inactiveUsers.map((user, index) => (
          <StyledListItem key={user.id || index}>
            <PersonOffIcon color="disabled" />
            <ListItemText
              primary={user.nombre}
              secondary={user.tipo_personal_id === 1 ? "Titular" : "Auxiliar"}
              style={{ textAlign: "center" }}
            />
            <div style={{ display: "flex", gap: "10px" }}>
              <IconButton
                color="primary"
                onClick={() => handleOpenModal(user, "reactivar")}
              >
                <RestoreIcon />
              </IconButton>
              <IconButton
                color="error"
                onClick={() => handleOpenModal(user, "eliminar")}
              >
                <DeleteIcon />
              </IconButton>
            </div>
          </StyledListItem>
        ))}
      </List>

      {renderModal()}
    </SectionWrapper>
  );
};

// Estilos del contenedor principal
const SectionWrapper = styled.div`
  padding: 20px;
  background-color: #f9f9f9;
  border-radius: 8px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
`;

// Estilos para las filas de la lista
const StyledListItem = styled(ListItem)`
  display: flex;
  justify-content: space-between;
  align-items: center;
  text-align: center;
`;

// Estilos del modal
const modalStyle = {
  position: "absolute",
  top: "50%",
  left: "50%",
  transform: "translate(-50%, -50%)",
  width: 400,
  bgcolor: "background.paper",
  boxShadow: 24,
  p: 4,
  borderRadius: "8px",
};

export default PersonalInactivo;

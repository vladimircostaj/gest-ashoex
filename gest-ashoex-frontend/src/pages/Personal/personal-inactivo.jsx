import React, { useState } from "react";
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
  Button,} from "@mui/material";
import RestoreIcon from "@mui/icons-material/Restore"; 
import DeleteIcon from "@mui/icons-material/Delete"; 
import PersonOffIcon from "@mui/icons-material/PersonOff"; 

const PersonalInactivo = () => {
  
  const [inactiveUsers, setInactiveUsers] = useState([
    { id: 1, name: "ivan", role: "Docente" },
    { id: 2, name: "Laura", role: "Administrador" },
    { id: 3, name: "pablo", role: "Auxiliar" },
  ]);

  
  const [openModal, setOpenModal] = useState(false);
  const [selectedUser, setSelectedUser] = useState(null);
  const [actionType, setActionType] = useState("");

  
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

  
  const renderModal = () => (
    <Modal open={openModal} onClose={handleCloseModal}>
      <Box sx={modalStyle}>
        <Typography variant="h6" component="h2">
          {actionType === "reactivar"
            ? `¿Reactivar a ${selectedUser?.name}?`
            : `¿Eliminar a ${selectedUser?.name}?`}
        </Typography>``
        <Typography sx={{ mt: 2 }}>
          {actionType === "reactivar"
            ? "El usuario será reactivado y regresará a la lista de personal activo."
            : "El usuario será eliminado permanentemente."}
        </Typography>
        <Box sx={{ display: "flex", justifyContent: "center", gap: "10px", mt: 3 }}>
          <Button variant="contained" color="primary" onClick={handleCloseModal}>
            Confirmar
          </Button>
          <Button variant="outlined" color="secondary" onClick={handleCloseModal}>
            Cancelar
          </Button>
        </Box>
      </Box>
    </Modal>
  );

  return (
    <SectionWrapper  className="mt-4">
      <h2 style={{ textAlign: 'center' }}>Personal Inactivo</h2>
      <Divider />
      <List>
        {inactiveUsers.map((user) => (
          <StyledListItem key={user.id}>
            <PersonOffIcon color="disabled" />
            <ListItemText
              primary={user.name}
              secondary={user.role}
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

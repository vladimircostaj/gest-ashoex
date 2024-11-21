import React from 'react';
import styled from 'styled-components';
import { IconButton, Divider } from '@mui/material';
import CloseIcon from '@mui/icons-material/Close';

const SliderBar = ({ isOpen, toggleSlider }) => {
  if (!isOpen) return null; // Si no está abierto, no se renderiza

  return (
    <SliderContainer>
      <SliderHeader>
        <Title>Gest - Ashoex</Title>
        <IconButton onClick={toggleSlider}>
          <CloseIcon style={{ color: 'white' }} />
        </IconButton>
      </SliderHeader>

      <Divider style={{ backgroundColor: 'gray' }} />

      {/* Aquí van los menús */}
      <Menu>
        <MenuItem>📅 Ambientes</MenuItem>
        <MenuItem>📘 Currícula</MenuItem>
        <MenuItem>🧑‍💼 Personal</MenuItem>
      </Menu>
    </SliderContainer>
  );
};

const SliderContainer = styled.div`
  width: 300px;
  height: 100%;
  background-color: black;
  color: white;
  position: fixed;
  top: 0;
  left: 0;
  z-index: 1200;
  padding: 20px;
  overflow-y: auto;
  box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.5);
`;

const SliderHeader = styled.div`
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding-bottom: 10px;
`;

const Title = styled.h1`
  font-size: 1.2rem;
  color: white;
`;

const Menu = styled.div`
  margin-top: 20px;
`;

const MenuItem = styled.div`
  margin-bottom: 20px;
  font-size: 1.2rem;
  cursor: pointer;

  &:hover {
    text-decoration: underline;
  }
`;

export default SliderBar;

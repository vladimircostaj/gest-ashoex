import React, { useState } from "react";
import styled from "styled-components";
import Logo from "../../images/logo.png";

const Header = ({ toggleSlider }) => {
  const [showPopup, setShowPopup] = useState(false);

  const handleLogoClick = () => {
    setShowPopup(!showPopup);
  };

  return (
    <StyledHeader>
      <HamburgerMenu onClick={toggleSlider}>
        <span></span>
        <span></span>
        <span></span>
      </HamburgerMenu>

      <Title>Gest - Ashoex</Title>

      <LogoContainer>
        <LogoImage src={Logo} alt="Logo" onClick={handleLogoClick} />
        {showPopup && (
          <Popup>
            <p>Ver Perfil</p>
          </Popup>
        )}
      </LogoContainer>
    </StyledHeader>
  );
};

const StyledHeader = styled.header`
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 10px 16px;
  background-color: #2d2a2a;
  color: white;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  z-index: 1000;
  box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
`;

const HamburgerMenu = styled.div`
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  width: 24px;
  height: 18px;
  cursor: pointer;

  span {
    display: block;
    height: 3px;
    background-color: white;
    border-radius: 5px;
    transition: background-color 0.3s ease-in-out;

    &:hover {
      background-color: #4e75ff;
    }
  }
`;

const Title = styled.h1`
  font-size: 1.5rem;
  font-weight: bold;
  margin: 0;
  text-align: center;
  flex: 1;
  padding: 0 10px;

  @media (max-width: 480px) {
    font-size: 1rem;
  }
`;

const LogoContainer = styled.div`
  display: flex;
  align-items: center;
  position: relative;
  margin-left: auto;
  margin-right: 30px;
`;

const LogoImage = styled.img`
  width: 40px;
  height: 40px;
  border-radius: 50%;
  border: 2px solid white;
  object-fit: cover;
  cursor: pointer;

  &:hover {
    border-color: #4e75ff;
  }
`;

const Popup = styled.div`
  position: absolute;
  top: 50px; /* Ajusta la posición debajo del logo */
  right: 0;
  background-color: white;
  border: 1px solid #ccc;
  border-radius: 8px;
  box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
  padding: 10px 15px;
  z-index: 1000;
  color: black;

  p {
    margin: 0;
    font-size: 0.9rem;
    font-weight: bold;
    cursor: pointer;

    &:hover {
      color: #4e75ff;
    }
  }
`;

export default Header;

import React from 'react';
import styled from 'styled-components';
import Logo from '../../images/logo.png';

const Header = ({ toggleSlider }) => {
  return (
    <StyledHeader>
      <HamburgerMenu onClick={toggleSlider}>
        <span></span>
        <span></span>
        <span></span>
      </HamburgerMenu>

      <Title>Gest - Ashoex</Title>

      <LogoContainer>
        <LogoImage src={Logo} alt="Logo" />
      </LogoContainer>
    </StyledHeader>
  );
};

const StyledHeader = styled.header`
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 10px 16px;
  background-color: black;
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
  font-size: 1.2rem;
  font-weight: bold;
  margin: 0;
  flex: 1;
  text-align: center;

  @media (max-width: 480px) {
    font-size: 1rem;
  }
`;

const LogoContainer = styled.div`
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  margin-left: -10px;
`;

const LogoImage = styled.img`
  width: 40px;
  height: 40px;
  border-radius: 50%;
  border: 2px solid white;
  object-fit: cover;
`;

export default Header;

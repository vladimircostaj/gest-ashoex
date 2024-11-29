import React from 'react';

const Title = ({ text, style = {} }) => {
  const defaultStyles = {
    textAlign: 'center',
    fontSize: '1.25rem', 
    fontWeight: '600',
    marginBottom: '20px',
    color: '#333',
  };

  return <h2 style={{ ...defaultStyles, ...style }}>{text}</h2>;
};

export default Title;

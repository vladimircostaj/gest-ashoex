import React from 'react';

const InputField = ({ label, id, type = 'text', placeholder, style = {} }) => {
  const defaultStyles = {
    container: {
      display: 'flex',
      flexDirection: 'column',
      gap: '5px',
    },
    label: {
      fontSize: '14px',
      fontWeight: '500',
      color: '#555',
    },
    input: {
      width: '100%',
      padding: '10px',
      borderRadius: '8px',
      border: '1px solid #ccc',
      fontSize: '14px',
    },
  };

  return (
    <div style={{ ...defaultStyles.container, ...style.container }}>
      <label htmlFor={id} style={{ ...defaultStyles.label, ...style.label }}>
        {label}
      </label>
      <input
        id={id}
        type={type}
        placeholder={placeholder}
        style={{ ...defaultStyles.input, ...style.input }}
      />
    </div>
  );
};

export default InputField;

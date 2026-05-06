import React from 'react';

const Avatar = ({ firstName = "", lastName = "", className = "" }) => {
  const initials = `${firstName.charAt(0)}${lastName.charAt(0)}`.toUpperCase();
  
  return (
    <div className={`flex items-center justify-center rounded-full bg-pink-700 text-white font-bold ${className}`} style={{ width: '40px', height: '40px' }}>
      {initials}
    </div>
  );
};

export default Avatar;
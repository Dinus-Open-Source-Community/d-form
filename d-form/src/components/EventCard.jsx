import React from 'react';

const EventCard = ({ id, category, title, date, onEventClick }) => {
  return (
    <div 
      className="bg-white rounded-lg shadow-md overflow-hidden cursor-pointer transition-transform transform hover:scale-105"
      onClick={() => onEventClick(id)}
    >
      <div className="h-48 bg-[#343434]"></div>
      <div className="p-4">
        <div className="flex flex-wrap gap-2 mb-2">
          {category.map((cat, index) => (
            <span 
              key={index} 
              className="inline-block text-xs font-medium px-3 py-1 rounded-lg bg-[#343434] text-white"
            >
              {cat}
            </span>
          ))}
        </div>
        <h3 className="text-base font-medium mb-2">{title}</h3>
        <p className="text-sm text-gray-600">{date}</p>
      </div>
    </div>
  );
};

export default EventCard;

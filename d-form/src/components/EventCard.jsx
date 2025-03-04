import React from 'react';

const EventCard = ({ id, category, title, date, onEventClick }) => {
  return (
    <div 
      className="bg-white rounded-lg shadow-md overflow-hidden cursor-pointer transition-transform transform hover:scale-105"
      onClick={() => onEventClick(id)}
    >
      <div className="h-36 sm:h-40 md:h-48 bg-[#343434]"></div>
      <div className="p-3 sm:p-4">
        <div className="flex flex-wrap gap-1 sm:gap-2 mb-2">
          {category.map((cat, index) => (
            <span 
              key={index} 
              className="inline-block text-xs font-medium px-2 sm:px-3 py-1 rounded-lg bg-[#343434] text-white"
            >
              {cat}
            </span>
          ))}
        </div>
        <h3 className="text-sm sm:text-base font-medium mb-1 sm:mb-2">{title}</h3>
        <p className="text-xs sm:text-sm text-gray-600">{date}</p>
      </div>
    </div>
  );
};

export default EventCard;
import React, { useEffect, useState, useCallback } from 'react';
import { useNavigate } from 'react-router-dom';


// PROPS CHANGE
// For simplicity, I change the props of EventCard from {id, category=[], title, date}
// to {id, event}
// Author : Felix
const EventCard = ({ id, event }) => {
  const [data, setData] = useState([]);
  const [error, setError] = useState(false);
  const navigate = useNavigate();
  
  const handleClick = useCallback(() => {
    navigate(`/admin/events/${id}`);
  }, [id, navigate]);


  return (
    <div 
      className="bg-white rounded-lg shadow-md overflow-hidden cursor-pointer transition-transform transform hover:scale-105"
      onClick={handleClick}
    >
      <div className="h-36 sm:h-40 md:h-48 bg-[#343434]"></div>
      <div className="p-3 sm:p-4 border-x-2 border-b-2 rounded-b-lg border-gray-400"> 
        <div className="flex flex-wrap gap-2 mb-2">
          
          {/* TEMPORARY DISABLE CARDS' ITERATION 
              Since the `category` (in the API`s migration named as `division`) type is 
              string and this section expect the category to be an array, I temporary disable the iteration. Once the backend for this got fixed, enable this section again.
              (Backend Routes : /api/v1/events)
              Author : Felix
          */}
          {/* Remove this <span> when API got fixed */}

          <span 
            key={`${id}-category`} 
            className="inline-block text-xs font-medium px-3 py-1 rounded-lg bg-[#343434] text-white"
          >
            {event.division}
          </span>

          {/* Enable this when API got fixed */}
          {/* {category.map((cat, index) => (
            <span 
              key={`${id}-${cat}-${index}`} 
              className="inline-block text-xs font-medium px-3 py-1 rounded-lg bg-[#343434] text-white"
            >
              {cat}
            </span>
          ))} */}
        </div>
        <h3 className="text-base font-medium mb-2">{event.name}</h3>
        <p className="text-sm text-gray-600">{event.start_date}</p>
      </div>
    </div>
  );
};

export default EventCard;
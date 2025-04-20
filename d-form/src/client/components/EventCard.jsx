import React from 'react';
import {format, addDays} from 'date-fns'
import { formatRangedDate } from '../../utils/DateHelper';
import { useState, useEffect } from 'react';


const EventCard = ({ id, event, onEventClick }) => {
  const [eventDate, setEventDate] = useState({});
  useEffect(()=>{
    if(Object.keys(event)?.length)
    {
      const formatted = formatRangedDate(event.start_date, addDays(event.start_date, event.duration_days))
      setEventDate(formatted);
      
    }
  }, [event])
  useEffect(()=>{
    console.log(eventDate.days);
  }, [eventDate])
  return (
    <div 
      className="bg-white rounded-xl shadow-md overflow-hidden cursor-pointer transition-transform transform hover:scale-105"
      onClick={() => onEventClick(id)}
    >
      <div className="h-36 sm:h-40 md:h-48 bg-[#343434]">
        <img src={event.cover_event} alt={event.id}  />
      </div>
      <div className="p-3 sm:p-4 border-x-2 border-b-2 rounded-b-xl border-gray-400">
        <div className="flex flex-wrap gap-1 sm:gap-2 mb-2">
            <span 
              key={`${id}-category`} 
              className="inline-block text-xs font-medium px-2 sm:px-3 py-1 rounded-lg bg-[#343434] text-white"
            >
              {event.division}
            </span>
          {/* {category.map((cat, index) => (
            <span 
              key={index} 
              className="inline-block text-xs font-medium px-2 sm:px-3 py-1 rounded-lg bg-[#343434] text-white"
            >
              {cat}
            </span>
          ))} */}
        </div>
        <h3 className="text-sm sm:text-base font-medium mb-1 sm:mb-2">{event.name}</h3>
        <p className="text-xs sm:text-sm text-gray-600">{event.description}</p>
        <p className="text-sm text-gray-400 mt-2"><b>{eventDate.days}</b> <br />{eventDate.months}</p>
      </div>
    </div>
  );
};


export default EventCard;
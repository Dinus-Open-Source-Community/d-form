import React from 'react';
import { format, addDays } from 'date-fns';
import { formatRangedDate } from '../../utils/DateHelper';
import { useState, useEffect } from 'react';
import { useNavigate } from 'react-router-dom';

const EventCard = ({ id, event }) => {
  const [eventDate, setEventDate] = useState({});
  const navigate = useNavigate();

  useEffect(() => {
    if (Object.keys(event)?.length) {
      const formatted = formatRangedDate(
        event.start_date,
        addDays(event.start_date, event.duration_days),
      );
      setEventDate(formatted);
    }
  }, [event]);

  useEffect(() => {
    console.log(eventDate.days);
  }, [eventDate]);

  const handleCardClick = () => {
    navigate(`/events/${id}`); // Navigasi ke halaman detail event
  };

  const truncateDescription = (text, maxLength = 100) => {
    if (!text) return '';
    if (text.length <= maxLength) return text;
    return `${text.substring(0, maxLength)}...`;
  };

  return (
    <div
      className="bg-white rounded-xl shadow-md overflow-hidden cursor-pointer transition-transform transform hover:scale-105 flex flex-col h-full"
      onClick={handleCardClick}
    >
      {/* Image section with cover photo */}
      <div className="h-36 sm:h-40 md:h-48 bg-[#343434] overflow-hidden">
        {event.cover_event ? (
          <img
            src={event.cover_event}
            alt={event.name || 'Event cover'}
            className="w-full h-full object-cover"
          />
        ) : (
          <div className="w-full h-full flex items-center justify-center text-white">
            Event Image
          </div>
        )}
      </div>

      {/* Card content area */}
      <div className="p-3 sm:p-4 border-x-2 border-b-2 rounded-b-xl border-gray-400 flex flex-col flex-grow">
        {/* Category tags section */}
        <div className="flex flex-wrap gap-1 sm:gap-2 mb-2">
          <span
            key={`${id}-category`}
            className="inline-block text-xs font-medium px-2 sm:px-3 py-1 rounded-lg bg-[#343434] text-white"
          >
            {event.division}
          </span>
        </div>

        {/* Event title and description */}
        <div className="flex-grow">
          <h3 className="text-sm sm:text-base font-medium mb-1 sm:mb-2 line-clamp-2">
            {event.name}
          </h3>
          <p className="text-xs sm:text-sm text-gray-600">
            {truncateDescription(event.description)}
          </p>
        </div>

        {/* Read More section */}
        {event.description && event.description.length > 100 && (
          <div className="mt-2">
            <span className="text-sm text-black-500 hover:text-gray-400">Read More</span>
          </div>
        )}

        {/* Date section - always at bottom */}
        <div className="mt-2 pt-2 border-t border-gray-200">
          <p className="text-sm text-gray-500">
            <b>{eventDate.days}</b> <br />
            {eventDate.months}
          </p>
        </div>
      </div>
    </div>
  );
};

export default EventCard;

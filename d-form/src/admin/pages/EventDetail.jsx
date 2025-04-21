import { Calendar, Clock, MapPin, Users, Copy as CopyIcon } from 'lucide-react';
import { useEffect, useState } from 'react';
import { useParams } from 'react-router-dom';
import { format, addDays } from 'date-fns';
import { formatRangedDate } from '../../utils/DateHelper';

const fetchEvent = async (eventID, setData, setError, setCode) => {
  const baseURL = import.meta.env.VITE_API_URL;
  const apiURL = `${baseURL}/events/${eventID}`;

  const res = await fetch(apiURL, {
    mode: 'cors',
    method: 'GET',
    headers: { 'Content-Type': 'application/json' },
  });
  let data;
  switch (res.status) {
    case 200:
      data = await res.json();
      console.log(data.data);
      setError(false);
      setData(data.data);
      break;
    case 404:
      setError(true);
      setData({});
      break;
  }
};

const PopupNotification = ({ message, type = 'success', show, onClose }) => {
  useEffect(() => {
    if (show) {
      const timer = setTimeout(() => onClose(), 2000);
      return () => clearTimeout(timer);
    }
  }, [show, onClose]);

  if (!show) return null;

  return (
    <div
      className={`fixed top-5 left-1/2 -translate-x-1/2 px-4 py-3 rounded-lg shadow-lg text-white z-50 transition-all duration-300
      ${type === 'success' ? 'bg-green-600' : 'bg-red-600'}`}
    >
      {message}
    </div>
  );
};

const EventDetail = () => {
  const [data, setData] = useState({});
  const [eventDate, setEventDate] = useState({});
  const [error, setError] = useState(false);
  const { id } = useParams();
  const [popup, setPopup] = useState({
    show: false,
    message: '',
    type: 'success',
  });
  const [showTable, setShowTable] = useState(false);

  const handleCopyLink = async (link) => {
    try {
      await navigator.clipboard.writeText(link);
      setPopup({
        show: true,
        message: 'Link copied to clipboard!',
        type: 'success',
      });
    } catch {
      setPopup({ show: true, message: 'Failed to copy link.', type: 'error' });
    }
  };

  useEffect(() => {
    fetchEvent(id, setData, setError);
  }, [id]);
  useEffect(() => {
    if (Object.keys(data)?.length) {
      const formatted = formatRangedDate(
        data.start_date,
        addDays(data.start_date, data.duration_days),
      );
      setEventDate(formatted);
    }
  }, [data]);

  const handleUploadCSV = () => {
    setShowTable(true);
  };

  return (
    <>
      <PopupNotification
        {...popup}
        onClose={() => setPopup((p) => ({ ...p, show: false }))}
      />
      {data && Object.keys(data).length > 0 && (
        <div className="p-8 pt-26 ml-60">
          <div className="grid grid-cols-1 md:grid-cols-4 gap-2">
            <div className="col-span-3">
              <h1 className="text-3xl text-[#343434] font-bold mb-5">
                {data.name}
              </h1>

              {/* Event Info Cards */}
              <div className="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-8 text-[#343434]">
                <div className="flex items-center gap-2">
                  <Calendar className="w-5 h-5" />
                  <span>
                    <span className="font-semibold">{eventDate.days}</span>{' '}
                    <br /> {eventDate.months}
                  </span>
                </div>

                <div className="flex items-center gap-2 font-semibold">
                  <Clock className="w-5 h-5" />
                  <span>
                    {format(
                      new Date(
                        new Date().toLocaleDateString() + ' ' + data.start_time,
                      ),
                      'kk:mm',
                    )}{' '}
                    -{' '}
                    {format(
                      new Date(
                        new Date().toLocaleDateString() + ' ' + data.end_time,
                      ),
                      'kk:mm',
                    )}
                  </span>
                </div>

                <div className="flex items-center gap-2 font-semibold">
                  <MapPin className="w-5 h-5" />
                  <span>{data.address}</span>
                </div>

                <div className="flex items-center gap-2">
                  <Users className="w-5 h-5" />
                  <span>
                    <span className="font-semibold">{data.participants}</span>{' '}
                    Participants
                  </span>
                </div>
              </div>

              <hr className="border-gray-300 my-4" />

              {/* Event Description */}
              <div className="flex flex-col space-y-4 text-[#000000] mt-6">
                {data.description}
                <button className="flex font-bold text-[#343434]">
                  Read More
                </button>
              </div>

              {showTable && (
                <>
                  <div className="mt-16 overflow-x-auto border-2 border-gray-500 rounded-xl">
                    <div className="text-center font-medium text-gray-600 my-4">
                      Open Source on The School.csv
                    </div>
                    <table className="min-w-full table-auto border-collapse border border-gray-300 shadow-md">
                      <thead className="bg-gray-100">
                        <tr>
                          <th className="border border-gray-300 px-6 py-3 text-left font-semibold text-sm text-gray-700">
                            No
                          </th>
                          <th className="border border-gray-300 px-6 py-3 text-left font-semibold text-sm text-gray-700">
                            Token
                          </th>
                          <th className="border border-gray-300 px-6 py-3 text-left font-semibold text-sm text-gray-700">
                            Nama
                          </th>
                          <th className="border border-gray-300 px-6 py-3 text-left font-semibold text-sm text-gray-700">
                            Asal Sekolah
                          </th>
                        </tr>
                      </thead>
                      <tbody className="bg-white">
                        <tr>
                          <td className="border border-gray-300 px-6 py-3 text-sm text-gray-800">
                            1
                          </td>
                          <td className="border border-gray-300 px-6 py-3 text-sm text-gray-800">
                            afsdfkjasdhf9af3fh23fjikh9w
                          </td>
                          <td className="border border-gray-300 px-6 py-3 text-sm text-gray-800">
                            Lorem Ipsum
                          </td>
                          <td className="border border-gray-300 px-6 py-3 text-sm text-gray-800">
                            Lorem Ipsum
                          </td>
                        </tr>
                        <tr>
                          <td className="border border-gray-300 px-6 py-3 text-sm text-gray-800">
                            2
                          </td>
                          <td className="border border-gray-300 px-6 py-3 text-sm text-gray-800">
                            f983hfj23hfsd87fh3jh3ffh9f
                          </td>
                          <td className="border border-gray-300 px-6 py-3 text-sm text-gray-800">
                            Ipsum Lorem
                          </td>
                          <td className="border border-gray-300 px-6 py-3 text-sm text-gray-800">
                            Ipsum Lorem
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </>
              )}
            </div>

            {/* Right Column - Buttom Coloms */}
            <div className="col-span-1 space-y-4">
              {/* Always show Edit button */}
              <div className="flex justify-center">
                <button className="w-48 bg-white border-2 border-black text-black py-2 rounded-xl font-medium hover:bg-gray-200">
                  Edit
                </button>
              </div>

              {/* Show CSV buttons only when table is shown */}
              {showTable && (
                <>
                  <div className="flex justify-center">
                    <button className="w-48 bg-white border-2 border-black text-black py-2 rounded-xl font-medium hover:bg-gray-200">
                      Reupload CSV
                    </button>
                  </div>
                  <div className="flex justify-center">
                    <button className="w-48 bg-white border-2 border-black text-black py-2 rounded-xl font-medium hover:bg-gray-200">
                      Download CSV
                    </button>
                  </div>
                  <div className="flex justify-center">
                    <button className="w-48 bg-white border-2 border-black text-black py-2 rounded-xl font-medium hover:bg-gray-200">
                      Download QR
                    </button>
                  </div>
                </>
              )}

              {/* Always show Scan QR and Registration URL buttons */}
              <div className="flex justify-center">
                <button className="w-48 bg-white border-2 border-black text-black py-2 rounded-xl font-medium hover:bg-gray-200">
                  Scan QR
                </button>
              </div>
              <div className="flex justify-center">
                <button
                  className="w-48 bg-white border-2 border-black text-black py-2 rounded-xl font-medium hover:bg-gray-200"
                  onClick={() => handleCopyLink(data.gform_url)}
                >
                  Registration URL
                  <span>
                    <CopyIcon className="w-5 h-5 inline-block ml-2" />
                  </span>
                </button>
              </div>
            </div>
          </div>

          {!showTable && (
            <>
              <div className="text-center pt-48 pb-4">
                <span className="font-bold text-gray-500">
                  CSV has not been uploaded!
                </span>
              </div>
              <div className="items-center flex justify-center">
                <button
                  onClick={handleUploadCSV}
                  className="w-48 bg-[#343434] text-white py-3 rounded-lg hover:bg-[#2a2a2a] transition-colors font-meidum cursor-pointer"
                >
                  Upload CSV
                </button>
              </div>
            </>
          )}
        </div>
      )}
    </>
  );
};

export default EventDetail;

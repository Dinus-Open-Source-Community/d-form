import { useState } from 'react';
import { Calendar, Clock, Upload, Users } from 'lucide-react';
import { useNavigate } from 'react-router-dom';

const AddEvent = () => {
  const navigate = useNavigate();

  const [formData, setFormData] = useState({
    name: '',
    googleFormUrl: '',
    registrationDate: '',
    eventDate: '',
    startTime: '',
    endTime: '',
    durationDays: 1,
    participants: 1,
    type: 'RKT',
    division: 'Not Specified',
    address: '',
    googleMapsUrl: '',
    description: '',
    image: null,
  });

  const [showSuccessModal, setShowSuccessModal] = useState(false);

  const handleChange = (e) => {
    const { name, value } = e.target;
    setFormData((prev) => ({ ...prev, [name]: value }));
  };

  const handleFileChange = (e) => {
    setFormData((prev) => ({ ...prev, image: e.target.files[0] }));
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    console.log(formData); // kirim ke API atau proses lainnya
    setShowSuccessModal(true);
  };

  const goToDashboard = () => {
    navigate('/admin/dashboard');
  };

  const handleCancel = () => {
    setShowSuccessModal(false); // Menutup modal
  };

  return (
    <div className="p-8 pt-28 ml-14 text-[#343434]">
      <form
        onSubmit={handleSubmit}
        className="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-6"
        autoComplete="off"
      >
        {/* LEFT COLUMN */}
        <div className="space-y-4">
          <input
            type="text"
            name="name"
            placeholder="Event Name"
            value={formData.name}
            onChange={handleChange}
            className="w-full border border-[#343434] rounded-lg px-4 py-2 placeholder-[#343434]"
            required
          />
          <input
            type="url"
            name="googleFormUrl"
            placeholder="Google Form URL"
            value={formData.googleFormUrl}
            onChange={handleChange}
            className="w-full border border-[#343434] rounded-lg px-4 py-2 placeholder-[#343434]"
            required
          />

          <div className="grid grid-cols-2 gap-4">
            <div className="relative">
              <label className="block text-sm font-medium mb-1">
                Registration Date
              </label>
              <input
                type="date"
                name="registrationDate"
                value={formData.registrationDate}
                onChange={handleChange}
                className="w-full p-2 border rounded"
                required
              />
            </div>
            <div className="relative">
              <label className="block text-sm font-medium mb-1">
                Event Date
              </label>
              <input
                type="date"
                name="eventDate"
                value={formData.eventDate}
                onChange={handleChange}
                className="w-full p-2 border rounded"
                required
              />
            </div>
          </div>

          <div className="flex gap-4">
            <div className="relative flex-2">
              <label className="block text-sm font-medium mb-1">
                Start Time
              </label>
              <input
                type="time"
                name="startTime"
                value={formData.startTime}
                onChange={handleChange}
                className="w-full p-2 border rounded"
                required
              />
            </div>
            <div className="relative flex-2">
              <label className="block text-sm font-medium mb-1">End Time</label>
              <input
                type="time"
                name="endTime"
                value={formData.endTime}
                onChange={handleChange}
                className="w-full p-2 border rounded"
                required
              />
            </div>
          </div>

          <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div className="flex flex-col">
              <label className="text-sm mb-1 font-medium text-[#343434]">
                Duration (days)
              </label>
              <div className="relative">
                <Calendar className="absolute left-3 top-1/2 transform -translate-y-1/2 text-[#343434] w-4 h-4" />
                <input
                  type="number"
                  name="durationDays"
                  min="1"
                  value={formData.durationDays}
                  onChange={handleChange}
                  className="w-full border border-[#343434] rounded-lg pl-10 pr-4 py-2 text-[#343434] placeholder-[#343434]"
                />
              </div>
            </div>

            <div className="flex flex-col">
              <label className="text-sm mb-1 font-medium text-[#343434]">
                Participants
              </label>
              <div className="relative">
                <Users className="absolute left-3 top-1/2 transform -translate-y-1/2 text-[#343434] w-4 h-4" />
                <input
                  type="number"
                  name="participants"
                  min="1"
                  value={formData.participants}
                  onChange={handleChange}
                  className="w-full border border-[#343434] rounded-lg pl-10 pr-4 py-2 text-[#343434] placeholder-[#343434]"
                />
              </div>
            </div>
          </div>

          <div>
            <label className="text-sm font-medium block mb-1">Type</label>
            <div className="flex gap-2">
              {['RKT', 'NON RKT'].map((type) => (
                <button
                  key={type}
                  type="button"
                  onClick={() => setFormData({ ...formData, type })}
                  className={`flex-1 px-4 py-2 rounded-lg font-semibold border ${
                    formData.type === type
                      ? 'bg-[#343434] text-white'
                      : 'border-[#343434] text-[#343434] hover:bg-[#343434] hover:text-white'
                  }`}
                >
                  {type}
                </button>
              ))}
            </div>
          </div>

          <div>
            <label className="text-sm font-medium block mb-1">Division</label>
            <div className="grid grid-cols-2 gap-2">
              {['Not Specified', 'Programming', 'Multimedia', 'Networking'].map(
                (div) => (
                  <button
                    key={div}
                    type="button"
                    onClick={() => setFormData({ ...formData, division: div })}
                    className={`px-3 py-2 rounded-lg text-sm border ${
                      formData.division === div
                        ? 'bg-[#343434] text-white'
                        : 'border-[#343434] text-[#343434] hover:bg-[#343434] hover:text-white'
                    }`}
                  >
                    {div}
                  </button>
                ),
              )}
            </div>
          </div>
        </div>

        {/* RIGHT COLUMN */}
        <div className="space-y-4 md:col-span-2">
          <input
            type="text"
            name="address"
            placeholder="Address"
            value={formData.address}
            onChange={handleChange}
            className="w-full border border-[#343434] rounded-lg px-4 py-2 placeholder-[#343434]"
            required
          />
          <input
            type="url"
            name="googleMapsUrl"
            placeholder="Google Maps URL"
            value={formData.googleMapsUrl}
            onChange={handleChange}
            className="w-full border border-[#343434] rounded-lg px-4 py-2 placeholder-[#343434]"
            required
          />
          <textarea
            name="description"
            placeholder="Description"
            rows="6"
            value={formData.description}
            onChange={handleChange}
            className="w-full border border-[#343434] rounded-lg px-4 py-2 placeholder-[#343434] resize-none"
            required
          ></textarea>
          <label
            htmlFor="file-upload"
            className="cursor-pointer w-full border border-[#343434] rounded-lg py-6 flex flex-col items-center justify-center text-[#343434] hover:bg-gray-100"
          >
            <Upload className="w-6 h-6 mb-2" />
            Click or drag image to upload
            <input
              id="file-upload"
              type="file"
              onChange={handleFileChange}
              className="hidden"
            />
          </label>

          {/* BUTTONS */}
          <div className="md:col-span-3 flex justify-end gap-4">
            <button
              type="button"
              className="border border-[#343434] text-[#343434] px-6 py-2 rounded-lg hover:bg-[#343434] hover:text-white"
            >
              Cancel
            </button>
            <button
              type="submit"
              className="bg-[#343434] text-white font-semibold px-6 py-2 rounded-lg hover:opacity-90"
            >
              Save
            </button>
          </div>
        </div>
      </form>

      {/* SUCCESS MODAL */}
      {showSuccessModal && (
        <div className="fixed inset-0 bg-white/50 flex items-center justify-center z-50">
          <div className="bg-[#343434]/80 text-white rounded-lg p-6 w-full max-w-md relative shadow-lg">
            {/* Ikon sukses */}
            <div className="flex justify-center mb-4">
              <div className="w-12 h-12 flex items-center justify-center rounded-full border-2 border-green-500 text-green-500 text-2xl">
                ✓
              </div>
            </div>

            {/* Teks konfirmasi */}
            <h3 className="text-center text-lg font-medium mb-6">
              New event has been successfully added!
            </h3>

            {/* Tombol aksi */}
            <div className="flex justify-center gap-4">
              <button
                onClick={goToDashboard}
                className="bg-white/50 hover:bg-[#343434] text-white font-semibold px-5 py-2 rounded-lg cursor-pointer"
              >
                Back to Dashboard
              </button>
            </div>

            {/* Tombol close (kanan atas) */}
            <button
              onClick={handleCancel}
              className="absolute top-4 right-4 text-white hover:text-[#343434] text-xl cursor-pointer"
            >
              &times;
            </button>
          </div>
        </div>
      )}
    </div>
  );
};

export default AddEvent;

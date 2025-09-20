<?php
// =============================================================================
// 5. EMAIL TEMPLATES
// =============================================================================

// File: resources/views/emails/recruitment/status.blade.php
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Recruitment DOSCOM</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 30px; text-align: center; border-radius: 10px 10px 0 0; }
        .content { background: #f8f9fa; padding: 30px; border-radius: 0 0 10px 10px; }
        .status-badge { display: inline-block; padding: 8px 16px; border-radius: 20px; font-weight: bold; text-transform: uppercase; letter-spacing: 1px; }
        .approved { background: #d4edda; color: #155724; }
        .rejected { background: #f8d7da; color: #721c24; }
        .footer { text-align: center; margin-top: 30px; padding-top: 20px; border-top: 1px solid #dee2e6; color: #6c757d; font-size: 14px; }
        .button { display: inline-block; padding: 12px 24px; background: #667eea; color: white; text-decoration: none; border-radius: 5px; margin: 10px 0; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🚀 DOSCOM</h1>
            <h2>Developer Student Community</h2>
        </div>
        
        <div class="content">
            <h2>Halo, {{ $recruitment->nama_lengkap }}!</h2>
            
            @if($isApproved)
                <div class="status-badge approved">✅ DITERIMA</div>
                
                <p>Selamat! Kami dengan senang hati memberitahukan bahwa Anda telah <strong>diterima</strong> untuk bergabung dengan DOSCOM sebagai:</p>
                
                <div style="background: white; padding: 20px; border-radius: 8px; margin: 20px 0; border-left: 4px solid #28a745;">
                    <h3 style="margin: 0; color: #28a745;">{{ $recruitment->divisi_utama }}</h3>
                    @if($recruitment->divisi_tambahan)
                        <p style="margin: 5px 0; color: #6c757d;">Divisi Tambahan: {{ $recruitment->divisi_tambahan }}</p>
                    @endif
                </div>
                
                @if($recruitment->catatan)
                    <div style="background: #e7f3ff; padding: 15px; border-radius: 8px; margin: 20px 0;">
                        <strong>Pesan dari Tim Recruitment:</strong>
                        <p style="margin: 10px 0;">{{ $recruitment->catatan }}</p>
                    </div>
                @endif
                
                <h3>Langkah Selanjutnya:</h3>
                <ul>
                    <li>Bergabung dengan grup WhatsApp divisi Anda</li>
                    <li>Menghadiri orientasi member baru</li>
                    <li>Memulai perjalanan learning dan development</li>
                </ul>
                
            @elseif($isRejected)
                <div class="status-badge rejected">❌ BELUM BERUNTUNG</div>
                
                <p>Terima kasih telah mendaftar untuk bergabung dengan DOSCOM. Setelah melalui proses seleksi yang ketat, kami merasa bahwa profil Anda belum sesuai dengan kebutuhan divisi saat ini.</p>
                
                @if($recruitment->catatan)
                    <div style="background: #fff3cd; padding: 15px; border-radius: 8px; margin: 20px 0; border-left: 4px solid #ffc107;">
                        <strong>Feedback dari Tim Recruitment:</strong>
                        <p style="margin: 10px 0;">{{ $recruitment->catatan }}</p>
                    </div>
                @endif
                
                <p>Jangan berkecil hati! Kami mendorong Anda untuk:</p>
                <ul>
                    <li>Terus mengembangkan skill di bidang yang diminati</li>
                    <li>Aktif mengikuti event dan workshop DOSCOM</li>
                    <li>Mencoba mendaftar lagi di periode recruitment berikutnya</li>
                </ul>
                
            @endif
            
            <div style="margin: 30px 0; padding: 20px; background: white; border-radius: 8px;">
                <h4>Detail Pendaftaran:</h4>
                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <td style="padding: 8px; border-bottom: 1px solid #dee2e6;"><strong>Nama:</strong></td>
                        <td style="padding: 8px; border-bottom: 1px solid #dee2e6;">{{ $recruitment->nama_lengkap }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px; border-bottom: 1px solid #dee2e6;"><strong>NIM:</strong></td>
                        <td style="padding: 8px; border-bottom: 1px solid #dee2e6;">{{ $recruitment->nim }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px; border-bottom: 1px solid #dee2e6;"><strong>Divisi:</strong></td>
                        <td style="padding: 8px; border-bottom: 1px solid #dee2e6;">{{ $recruitment->divisi_utama }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px; border-bottom: 1px solid #dee2e6;"><strong>Status:</strong></td>
                        <td style="padding: 8px; border-bottom: 1px solid #dee2e6;">
                            <span class="status-badge {{ $isApproved ? 'approved' : 'rejected' }}">
                                {{ $recruitment->status_label }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 8px;"><strong>Tgl Review:</strong></td>
                        <td style="padding: 8px;">{{ $recruitment->reviewed_at->format('d F Y, H:i') }}</td>
                    </tr>
                </table>
            </div>
            
            @if($isApproved)
                <div style="text-align: center; margin: 30px 0;">
                    <a href="https://chat.whatsapp.com/doscom-group" class="button">
                        📱 Join WhatsApp Group
                    </a>
                </div>
            @endif
            
        </div>
        
        <div class="footer">
            <p>
                Email ini dikirim otomatis oleh sistem DOSCOM.<br>
                Jika ada pertanyaan, silakan hubungi: <strong>admin@doscom.org</strong>
            </p>
            
            <div style="margin-top: 20px;">
                <a href="https://doscom.org" style="color: #667eea; text-decoration: none; margin: 0 10px;">Website</a>
                <a href="https://instagram.com/doscom" style="color: #667eea; text-decoration: none; margin: 0 10px;">Instagram</a>
                <a href="https://linkedin.com/company/doscom" style="color: #667eea; text-decoration: none; margin: 0 10px;">LinkedIn</a>
            </div>
            
            <p style="margin-top: 20px; font-size: 12px;">
                © {{ date('Y') }) DOSCOM - Developer Student Community<br>
                Universitas Dian Nuswantoro, Semarang
            </p>
        </div>
    </div>
</body>
</html>

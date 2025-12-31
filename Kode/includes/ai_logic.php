<?php
function translateWithGemini($text, $apiKey) {
    // --- LOGIKA ASLI ANDA (TIDAK DIRUBAH) ---
    $listUrl = "https://generativelanguage.googleapis.com/v1beta/models?key=" . $apiKey;
    
    $ch = curl_init($listUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $listResponse = curl_exec($ch);
    $listData = json_decode($listResponse, true);
    curl_close($ch);

    $activeModel = "";
    if (isset($listData['models'])) {
        foreach ($listData['models'] as $m) {
            if (in_array("generateContent", $m['supportedGenerationMethods'])) {
                $activeModel = $m['name']; 
                break;
            }
        }
    }

    if (empty($activeModel)) {
        return "Error: Tidak ada model aktif di Key ini.";
    }

    // --- PENAMBAHAN INSTRUKSI AGAR TIDAK BERTELE-TELE ---
    $url = "https://generativelanguage.googleapis.com/v1beta/" . $activeModel . ":generateContent?key=" . $apiKey;
    $data = [
        "contents" => [["parts" => [["text" => "Terjemahkan ke Bahasa Lampung secara singkat tanpa penjelasan dan tanpa tanda bintang: " . $text]]]]
    ];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    
    $response = curl_exec($ch);
    $result = json_decode($response, true);
    curl_close($ch);

    if (isset($result['candidates'][0]['content']['parts'][0]['text'])) {
        $hasil_ai = $result['candidates'][0]['content']['parts'][0]['text'];
        
        // --- PENAMBAHAN MEMBERSIHKAN BINTANG (MARKDOWN) ---
        $hasil_bersih = str_replace(['**', '*'], '', $hasil_ai);
        return trim($hasil_bersih);
    }

    return "API ditemukan (" . $activeModel . "), tapi gagal memproses teks.";
}
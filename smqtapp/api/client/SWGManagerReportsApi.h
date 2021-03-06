/**
 * SMARTBUS API
 * No description provided (generated by Swagger Codegen https://github.com/swagger-api/swagger-codegen)
 *
 * OpenAPI spec version: 1.0.0
 * 
 *
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen.git
 * Do not edit the class manually.
 */

#ifndef _SWG_SWGManagerReportsApi_H_
#define _SWG_SWGManagerReportsApi_H_

#include "SWGHttpRequest.h"

#include "ModelReceiptDetail.h"
#include "ModelReceiptForm.h"
#include "ModelReceiptView.h"
#include "ModelRpRouteForm.h"
#include "ModelRpStaffForm.h"
#include <QString>

#include <QObject>

namespace api {

class SWGManagerReportsApi: public QObject {
    Q_OBJECT

public:
    SWGManagerReportsApi();
    SWGManagerReportsApi(QString host, QString basePath);
    ~SWGManagerReportsApi();

    QString host;
    QString basePath;
    QMap<QString, QString> defaultHeaders;

    void managerReportsExportReceipt(ModelReceiptForm body);
    void managerReportsExportRoute(ModelRpRouteForm body);
    void managerReportsExportStaff(ModelRpStaffForm body);
    void managerReportsGetReceiptDetailByShiftId(qint64 shift_id);
    void managerReportsViewReceipt(ModelReceiptForm body);
    
private:
    void managerReportsExportReceiptCallback (HttpRequestWorker * worker);
    void managerReportsExportRouteCallback (HttpRequestWorker * worker);
    void managerReportsExportStaffCallback (HttpRequestWorker * worker);
    void managerReportsGetReceiptDetailByShiftIdCallback (HttpRequestWorker * worker);
    void managerReportsViewReceiptCallback (HttpRequestWorker * worker);
    
signals:
    void managerReportsExportReceiptSignal(QString* summary);
    void managerReportsExportRouteSignal(QString* summary);
    void managerReportsExportStaffSignal(QString* summary);
    void managerReportsGetReceiptDetailByShiftIdSignal(ModelReceiptDetail* summary);
    void managerReportsViewReceiptSignal(QList<ModelReceiptView*>* summary);
    
    void managerReportsExportReceiptSignalE(QString* summary, QNetworkReply::NetworkError error_type, QString& error_str);
    void managerReportsExportRouteSignalE(QString* summary, QNetworkReply::NetworkError error_type, QString& error_str);
    void managerReportsExportStaffSignalE(QString* summary, QNetworkReply::NetworkError error_type, QString& error_str);
    void managerReportsGetReceiptDetailByShiftIdSignalE(ModelReceiptDetail* summary, QNetworkReply::NetworkError error_type, QString& error_str);
    void managerReportsViewReceiptSignalE(QList<ModelReceiptView*>* summary, QNetworkReply::NetworkError error_type, QString& error_str);
    
    void managerReportsExportReceiptSignalEFull(HttpRequestWorker* worker, QNetworkReply::NetworkError error_type, QString& error_str);
    void managerReportsExportRouteSignalEFull(HttpRequestWorker* worker, QNetworkReply::NetworkError error_type, QString& error_str);
    void managerReportsExportStaffSignalEFull(HttpRequestWorker* worker, QNetworkReply::NetworkError error_type, QString& error_str);
    void managerReportsGetReceiptDetailByShiftIdSignalEFull(HttpRequestWorker* worker, QNetworkReply::NetworkError error_type, QString& error_str);
    void managerReportsViewReceiptSignalEFull(HttpRequestWorker* worker, QNetworkReply::NetworkError error_type, QString& error_str);
    
};

}
#endif

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

#ifndef _SWG_SWGAdminPermissionsApi_H_
#define _SWG_SWGAdminPermissionsApi_H_

#include "SWGHttpRequest.h"

#include "ModelPermission.h"
#include "ModelPermissionForm.h"

#include <QObject>

namespace api {

class SWGAdminPermissionsApi: public QObject {
    Q_OBJECT

public:
    SWGAdminPermissionsApi();
    SWGAdminPermissionsApi(QString host, QString basePath);
    ~SWGAdminPermissionsApi();

    QString host;
    QString basePath;
    QMap<QString, QString> defaultHeaders;

    void createPermission(ModelPermissionForm body);
    void deletePermission(qint64 permission_id);
    void getPermissionById(qint64 permission_id);
    void listPermissions(qint32 page, qint32 limit);
    void updatePermission(ModelPermissionForm body);
    
private:
    void createPermissionCallback (HttpRequestWorker * worker);
    void deletePermissionCallback (HttpRequestWorker * worker);
    void getPermissionByIdCallback (HttpRequestWorker * worker);
    void listPermissionsCallback (HttpRequestWorker * worker);
    void updatePermissionCallback (HttpRequestWorker * worker);
    
signals:
    void createPermissionSignal(ModelPermission* summary);
    void deletePermissionSignal();
    void getPermissionByIdSignal(ModelPermission* summary);
    void listPermissionsSignal(QList<ModelPermission*>* summary);
    void updatePermissionSignal(ModelPermission* summary);
    
    void createPermissionSignalE(ModelPermission* summary, QNetworkReply::NetworkError error_type, QString& error_str);
    void deletePermissionSignalE(QNetworkReply::NetworkError error_type, QString& error_str);
    void getPermissionByIdSignalE(ModelPermission* summary, QNetworkReply::NetworkError error_type, QString& error_str);
    void listPermissionsSignalE(QList<ModelPermission*>* summary, QNetworkReply::NetworkError error_type, QString& error_str);
    void updatePermissionSignalE(ModelPermission* summary, QNetworkReply::NetworkError error_type, QString& error_str);
    
    void createPermissionSignalEFull(HttpRequestWorker* worker, QNetworkReply::NetworkError error_type, QString& error_str);
    void deletePermissionSignalEFull(HttpRequestWorker* worker, QNetworkReply::NetworkError error_type, QString& error_str);
    void getPermissionByIdSignalEFull(HttpRequestWorker* worker, QNetworkReply::NetworkError error_type, QString& error_str);
    void listPermissionsSignalEFull(HttpRequestWorker* worker, QNetworkReply::NetworkError error_type, QString& error_str);
    void updatePermissionSignalEFull(HttpRequestWorker* worker, QNetworkReply::NetworkError error_type, QString& error_str);
    
};

}
#endif
